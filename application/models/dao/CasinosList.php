<?php
require_once("entities/Casino.php");
require_once("entities/CasinoBonus.php");

class CasinosList
{
    const LIMIT = 50;
    private $filter;

    public function __construct(CasinoFilter $filter)
    {
        $this->filter = $filter;
    }

    public function getResults($sortBy, $page, $limit = self::LIMIT,$offset = "") {
        $output = array();
        $order = "";
        if ($offset == "") {
            $offset = ($page*$limit);
        }
        // build query
        switch($sortBy) {
            case CasinoSortCriteria::NEWEST:
                $order .= " ORDER BY t1.date_established DESC, t1.priority DESC"."\n";
                break;
            case CasinoSortCriteria::TOP_RATED:
                $order .= " ORDER BY average_rating DESC, t1.priority DESC, t1.id DESC"."\n";
                break;
            case CasinoSortCriteria::POPULARITY:
                $order .= " ORDER BY t1.clicks DESC, t1.id DESC"."\n";
                break;
            default:
                $order .= " ORDER BY t1.priority DESC, t1.id DESC"."\n";
                $this->filter->setPromoted(TRUE);
                break;
        }
        $query = $this->getQuery(array("t1.id", "t1.name", "t1.code", "(t1.rating_total/t1.rating_votes) AS average_rating", "t1.date_established", "IF(t2.id IS NOT NULL, 1, 0) AS is_country_supported"));
        $query .= $order;
        $query .= "LIMIT ".$limit." OFFSET ".$offset;
        // execute query
        $resultSet = DB($query);
        while($row = $resultSet->toRow()) {
            $object = new Casino();
            $object->id = $row["id"];
            $object->name = $row["name"];
            $object->code = $row["code"];
            $object->rating = ceil($row["average_rating"]);
            $object->is_country_accepted = $row["is_country_supported"];
            $object->date_established = $row["date_established"];
            $object->date_formatted = $this->formatDate($row["date_established"]);
            $output[$row["id"]] = $object;
        }
        if(empty($output)) return array();

        // signal engine that utf8 is expected to come
        DB("SET names utf8");
        //append main software
        $query = "
        SELECT t1.casino_id, t2.name 
        FROM casinos__game_manufacturers AS t1
        INNER JOIN game_manufacturers AS t2 ON t1.game_manufacturer_id = t2.id
        WHERE t1.casino_id IN (".implode(",", array_keys($output)).") AND t1.is_primary = 1
        ";
        
        
        $resultSet = DB($query);
        while($row = $resultSet->toRow()) {
            $output[$row["casino_id"]]->main_software = $row["name"];
        }
        
        // append softwares
        $query = "
        SELECT t1.casino_id, t2.name 
        FROM casinos__game_manufacturers AS t1
        INNER JOIN game_manufacturers AS t2 ON t1.game_manufacturer_id = t2.id
        WHERE t1.casino_id IN (".implode(",", array_keys($output)).") AND t1.is_primary = 0;
        ";
        $resultSet = DB($query);
        while($row = $resultSet->toRow()) {
            $output[$row["casino_id"]]->softwares[] = $row["name"];
        }
        // append bonuses
        $query = "
        SELECT t1.casino_id, t1.codes, t1.amount, t1.wagering, t1.minimum_deposit, t1.games, t2.name 
        FROM casinos__bonuses AS t1
        INNER JOIN bonus_types AS t2 ON t1.bonus_type_id = t2.id
        WHERE t1.casino_id IN (".implode(",", array_keys($output)).") AND t2.name IN ('No Deposit Bonus','First Deposit Bonus','Free Spins','Free Play')
        ";
        $resultSet = DB($query);
        while($row = $resultSet->toRow()) {
            $bonus = new CasinoBonus();
            $bonus->amount = ($row["name"]=="Free Spins"?trim(str_replace("FS","",$row["amount"])):$row["amount"]);
            $bonus->min_deposit = $row["minimum_deposit"];
            $bonus->wagering = $row["wagering"];
            $bonus->games_allowed = $row["games"];
            $bonus->code = $row["codes"];
            $bonus->type = $row["name"];
            if($row["name"]=="No Deposit Bonus" || $row["name"]=="Free Spins" || $row["name"]=="Free Play") {
                $output[$row["casino_id"]]->bonus_free = $bonus;
            } else {
                $output[$row["casino_id"]]->bonus_first_deposit = $bonus;
            }
        }
        return array_values($output);
    }
    
    public function formatDate($date) {
        $date_arr = explode('-', $date);
        $month_name = date('M', strtotime($date));
        return $month_name.'. '.$date_arr[2].', '.$date_arr[0];
    }

    public function getTotal() {
        // build query
        $query = $this->getQuery(array("COUNT(t1.id) AS nr"));
        return (integer) DB($query)->toValue();
    }

    private function getQuery($columns) {
        $query = "
        SELECT
            ".implode(",", $columns)."
        FROM casinos AS t1
        ";
        if ($this->filter->getCurrencyAccepted()) {
            $query.="INNER JOIN casinos__currencies AS t2 ON t1.id = t2.casino_id AND t2.currency_id = ".$this->filter->currency_id."\n";
        } elseif($this->filter->getLanguageAccepted()) {
            $query.="INNER JOIN casinos__languages AS t2 ON t1.id = t2.casino_id AND t2.language_id = ".$this->filter->language_id."\n";
        } elseif($this->filter->getCountryAccepted()) {
            $query.="INNER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id AND t2.country_id = ".$this->filter->getDetectedCountry()->id."\n";
        } else {
            $query.="LEFT JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id AND t2.country_id = ".$this->filter->getDetectedCountry()->id."\n";
        }
        if($this->filter->getBankingMethod()) {
            $query.="INNER JOIN casinos__deposit_methods AS t3 ON t1.id = t3.casino_id AND t3.banking_method_id = (SELECT id FROM banking_methods WHERE name='".$this->filter->getBankingMethod()."')"."\n";
        }
        if($this->filter->getBonusType() || $this->filter->getFreeBonus()) {
            $condition = "";
            if($this->filter->getBonusType() && in_array(strtolower($this->filter->getBonusType()),array("free spins","no deposit bonus"))) {
                // free bonus is no longer relevant
                $condition = "t4.bonus_type_id = (SELECT id FROM bonus_types WHERE name='".$this->filter->getBonusType()."')";
            } else {
                $condition = ($this->filter->getBonusType()?"t4.bonus_type_id = (SELECT id FROM bonus_types WHERE name='".$this->filter->getBonusType()."') AND ":"");
                $condition .= ($this->filter->getFreeBonus()?"t4.bonus_type_id IN (5,6) AND ":"");
                $condition = substr($condition,0,-4);
            }
            $query.="INNER JOIN casinos__bonuses AS t4 ON t1.id = t4.casino_id AND ".$condition."\n";
        }
        if($this->filter->getCasinoLabel()) {
            if ($this->filter->getCasinoLabel() == "Stay away") {
                $this->filter->setPromoted(FALSE);
            }
            
            if ($this->filter->getCasinoLabel() != "New") {
                $query.="INNER JOIN casinos__labels AS t5 ON t1.id = t5.casino_id AND t5.label_id = (SELECT id FROM casino_labels WHERE name='".$this->filter->getCasinoLabel()."')"."\n";
            }
        }
        if($this->filter->getCertification()) {
            $query.="INNER JOIN casinos__certifications AS t6 ON t1.id = t6.casino_id AND t6.certification_id = (SELECT id FROM certifications WHERE name='".$this->filter->getCertification()."')"."\n";
        }
        if($this->filter->getCountry()) {
            $query.="INNER JOIN casinos__countries_allowed AS t7 ON t1.id = t7.casino_id AND t7.country_id = (SELECT id FROM countries WHERE name='".$this->filter->getCountry()."')"."\n";
        }
        if($this->filter->getOperatingSystem()) {
            $query.="INNER JOIN casinos__operating_systems AS t8 ON t1.id = t8.casino_id AND t8.operating_system_id = (SELECT id FROM operating_systems WHERE name='".$this->filter->getOperatingSystem()."')"."\n";
        }
        if($this->filter->getPlayVersion()) {
            $query.="INNER JOIN casinos__play_versions AS t9 ON t1.id = t9.casino_id AND t9.play_version_id = (SELECT id FROM play_versions WHERE name='".$this->filter->getPlayVersion()."')"."\n";
        }
        if($this->filter->getSoftware()) {
            $query.="INNER JOIN casinos__game_manufacturers AS t10 ON t1.id = t10.casino_id AND t10.game_manufacturer_id = (SELECT id FROM game_manufacturers WHERE name='".$this->filter->getSoftware()."')"."\n";
        }
        if($this->filter->getGame()) {
            $query.="INNER JOIN casinos__game_manufacturers AS t10 ON t1.id = t10.casino_id AND t10.game_manufacturer_id = (SELECT id FROM game_manufacturers WHERE name='".$this->filter->getSoftware()."')"."\n";
        }
        $query.="WHERE t1.is_open = 1 AND ";
        if($this->filter->getHighRoller()) {
            $query.="t1.is_high_roller = 1 AND ";
        }
        if($this->filter->getPromoted()) {
            $query.="t1.status_id = 0 AND ";
        }
        if($this->filter->getCasinoLabel()=="New") {
            $query.="t1.date_established > DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND ";
        }
        $query = substr($query,0, -4)."\n";
        return $query;
    }
}