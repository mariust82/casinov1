<?php
require_once("entities/Casino.php");
require_once("entities/CasinoBonus.php");
require_once("queries/CasinosListQuery.php");

class CasinosList
{
    const LIMIT = 100;
    private $filter;

    public function __construct(CasinoFilter $filter)
    {
        $this->filter = $filter;
    }

    public function getResults($sortBy, $page = 1, $limit = self::LIMIT, $offset = "")
    {
        $output = array();
        $fields = array( "t1.id" , "t1.status_id", "t1.name", "t1.code", "(t1.rating_total/t1.rating_votes) AS average_rating", "t1.date_established", "IF(t2.id IS NOT NULL, 1, 0) AS is_country_supported", "IF(t1.tc_link<>'', 1, 0) AS is_tc_link");

        $queryGenerator = new CasinosListQuery(
            $this->filter,
            $fields,
            $sortBy,
            $limit,
            $offset
        );
        $query = $queryGenerator->getQuery();

        // execute query
        $resultSet = SQL($query);

        while ($row = $resultSet->toRow()) {
            $object = new Casino();
            $object->id = $row["id"];
            $object->name = $row["name"];
            $object->code = $row["code"];
            $object->rating = ceil($row["average_rating"]);
            $object->is_country_accepted = $row["is_country_supported"];
            $object->date_established = $row["date_established"];
            $object->date_formatted = $this->formatDate($row["date_established"]);
            $object->status = $row["status_id"];
            $object->is_tc_link = $row["is_tc_link"];
            $object->logo_big = $this->getCasinoLogo($object->code = $row["code"], "124x82"); //  $object->logo_big = "/public/sync/casino_logo_light/124x82/".strtolower(str_replace(" ", "_", $object->code)).".png";
            $object->logo_small = $this->getCasinoLogo($object->code = $row["code"], "85x56");//   $object->logo_small = "/public/sync/casino_logo_light/85x56/".strtolower(str_replace(" ", "_", $object->code)).".png";
            $object->new = $this->isCasinoNew($row["date_established"]);
            $object->score_class = $this->getScoreClass($object->rating);
            if ($this->filter->getBankingMethod()) {
                $object->deposit_methods = $row["has_dm"];
                $object->withdraw_methods = $row["has_wm"];
            }
            $output[$row["id"]] = $object;
        }
        if (empty($output)) {
            return array();
        }
        var_dump($output);
        // append softwares
        $query = "
        SELECT t1.casino_id, t2.name 
        FROM casinos__game_manufacturers AS t1
        INNER JOIN game_manufacturers AS t2 ON t1.game_manufacturer_id = t2.id
        WHERE t1.casino_id IN (".implode(",", array_keys($output)).") ORDER BY t1.is_primary DESC;
        ";
        $list = NoSQL($query, [], function ($resultSet) {
            return $resultSet->toList();
        });
        foreach ($list as $row) {
            $output[$row["casino_id"]]->softwares[] = $row["name"];
        }
        var_dump($output);
        // append bonuses
        $query = "
        SELECT t1.casino_id, t1.codes, t1.amount, t1.wagering, t1.minimum_deposit, t1.games, t2.name , t1.bonus_type_id
        FROM casinos__bonuses AS t1
        INNER JOIN bonus_types AS t2 ON t1.bonus_type_id = t2.id
        WHERE t1.casino_id IN (".implode(",", array_keys($output)).") AND t2.name IN ('No Deposit Bonus','First Deposit Bonus','Free Spins','Free Play')
        ";
        $resultSet = SQL($query);
        while ($row = $resultSet->toRow()) {
            $bonus = new CasinoBonus();
            $bonus->amount = ($row["name"]=="Free Spins"?trim(str_replace("FS", "", $row["amount"])):$row["amount"]);
            $bonus->amount = $this->checkForAbbr($bonus->amount);
            $bonus->min_deposit = $row["minimum_deposit"];
            if ($row["wagering"] == '') {
                $row["wagering"] = 0;
            }
            $bonus->wagering = $row["wagering"];
            $bonus->games_allowed = $row["games"];
            $bonus->code = $row["codes"];
            $bonus->type = $row["name"];
            if ($row["name"]=="No Deposit Bonus" || $row["name"]=="Free Spins" || $row["name"]=="Free Play" || $row["name"]=="Bonus Spins") {
                $output[$row["casino_id"]]->bonus_free = $bonus;
                $output[$row["casino_id"]]->bonus_free->bonus_type_Abbreviation = $this->getAbbreviation($output[$row["casino_id"]]->bonus_free->type);
            } else {
                $output[$row["casino_id"]]->bonus_first_deposit = $bonus;
                //  $output[$row["casino_id"]]->bonus_first_deposit =  $this->getAbbreviation($output[$row["casino_id"]]->bonus_first_deposit->type);
            }
        }
        var_dump($output);
        foreach ($output as $arg) {
            if (sizeof($arg->softwares)>1) {
                $arg->all_softwares = $this->get_string($arg->softwares);
            }
        }
        return array_values($output);
    }

    public function formatDate($date)
    {
        $date_arr = explode('-', $date);
        $month_name = date('M', strtotime($date));
        return $month_name.'. '.$date_arr[2].', '.$date_arr[0];
    }

    public function getTotal()
    {
        // build query
        $queryGenerator = new CasinosListQuery($this->filter, array("COUNT(t1.id) AS nr"), null, 0, '', false);
        $query = $queryGenerator->getQuery();
        return SQL($query)->toValue();
    }

    private function getCasinoLogo($name, $resolution)
    {
        $logoDirPath = "/public/sync/casino_logo_light/".$resolution;
        $logoFile = strtolower(str_replace(" ", "_", $name)).".png";
        $logo = $logoDirPath.'/'.$logoFile;

        if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$logo)) {
            $logo =$logoDirPath."/no-logo-{$resolution}.png";
        }
        return $logo;
    }

    private function isCasinoNew($date)
    {
        $date_old = new DateTime($date);
        $today = new DateTime(date('Y-m-d'));

        if ($today->getTimestamp()-$date_old->getTimestamp()<=31536000) {
            return true;
        } else {
            return false;
        }
    }

    private function getScoreClass($score)
    {
        if ($score == 0) {
            return 'No score';
        } elseif ($score >= 1 && $score <= 4.99) {
            return  'Poor';
        } elseif ($score >= 5 && $score <= 7.99) {
            return  'Good';
        } elseif ($score >= 8 && $score <= 10) {
            return 'Excellent';
        }
    }

    private function getAbbreviation($name)
    {
        $words = explode(" ", $name);
        $abbr = "";

        foreach ($words as $word) {
            $abbr .= $word[0];
        }
        return $abbr;
    }

    private function get_string($name)
    {
        foreach ($name as $key => $item) {
            if ($key != 0) {
                $items[$key] = $item;
            }
        }
        return implode(", ", $items);
    }

    public function getFilter()
    {
        return $this->filter;
    }

    private function checkForAbbr($amount) {
        if (strpos($amount, 'FS') !== false) {
            return str_replace("FS",'<abbr title="Free Spins"> FS',$amount);
        }
        if (strpos($amount, 'NDB') !== false) {
            return str_replace("NDB",'<abbr title="No Deposit Bonus"> NDB',$amount);
        }
        if (strpos($amount, 'CB') !== false) {
            return str_replace("CB",'<abbr title="Cashback "> CB',$amount);
         }
        if (strpos($amount, 'FDB') !== false) {
            return str_replace("FDB",'<abbr title="First Deposit Bonus"> FDB',$amount);
        }
        return $amount;
    }

}
