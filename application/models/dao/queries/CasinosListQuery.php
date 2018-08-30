<?php
class CasinosListQuery
{
    private $query;

    public function __construct(CasinoFilter $filter, $columns, $sortBy=null, $limit= 0 , $offset='')
    {
        $this->setQuery($filter, $columns, $sortBy, $limit , $offset);

    }

    private function setQuery(CasinoFilter $filter, $columns, $sortBy,  $limit= 0 , $offset) {
        $query = "
        SELECT DISTINCT
            ".implode(",", $columns)."
        FROM casinos AS t1
        ";

        if ($filter->getCurrencyAccepted()) {
            $query.="INNER JOIN casinos__currencies AS t15 ON t1.id = t15.casino_id AND t15.currency_id = ".$filter->currency_id."\n";
        }

        if($filter->getLanguageAccepted()) {
            $query.="INNER JOIN casinos__languages AS t16 ON t1.id = t16.casino_id AND t16.language_id = ".$filter->language_id."\n";
        }

        if($filter->getCountryAccepted()) {
            $query.="INNER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id AND t2.country_id = ".$filter->getDetectedCountry()->id."\n";
        } else {
            $query.="LEFT JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id AND t2.country_id = ".$filter->getDetectedCountry()->id."\n";
        }
        if($filter->getBankingMethod()) {
            $query.="INNER JOIN casinos__deposit_methods AS t3 ON t1.id = t3.casino_id AND t3.banking_method_id = (SELECT id FROM banking_methods WHERE name='".$filter->getBankingMethod()."')"."\n";
        }
        if($filter->getBonusType() || $filter->getFreeBonus()) {
            $condition = "";
            if($filter->getBonusType() && in_array(strtolower($filter->getBonusType()),array("free spins","no deposit bonus"))) {
                // free bonus is no longer relevant
                $condition = "t4.bonus_type_id = (SELECT id FROM bonus_types WHERE name='".$filter->getBonusType()."')";
            } else {
                $condition = ($filter->getBonusType()?"t4.bonus_type_id = (SELECT id FROM bonus_types WHERE name='".$filter->getBonusType()."') AND ":"");
                $condition .= ($filter->getFreeBonus()?"t4.bonus_type_id IN (5,6) AND ":"");
                $condition = substr($condition,0,-4);
            }
            $query.="INNER JOIN casinos__bonuses AS t4 ON t1.id = t4.casino_id AND ".$condition."\n";
        }
        if($filter->getCasinoLabel()) {
            if ($filter->getCasinoLabel() == "Stay away") {
                $filter->setPromoted(FALSE);
            }

            if ($filter->getCasinoLabel() != "New") {
                $query.="INNER JOIN casinos__labels AS t5 ON t1.id = t5.casino_id AND t5.label_id = (SELECT id FROM casino_labels WHERE name='".$filter->getCasinoLabel()."')"."\n";
            }
        }
        if($filter->getCertification()) {
            $query.="INNER JOIN casinos__certifications AS t6 ON t1.id = t6.casino_id AND t6.certification_id = (SELECT id FROM certifications WHERE name='".$filter->getCertification()."')"."\n";
        }
        if($filter->getCountry()) {
            $query.="INNER JOIN casinos__countries_allowed AS t7 ON t1.id = t7.casino_id AND t7.country_id = (SELECT id FROM countries WHERE name='".$filter->getCountry()."')"."\n";
        }
        if($filter->getOperatingSystem()) {
            $query.="INNER JOIN casinos__operating_systems AS t8 ON t1.id = t8.casino_id AND t8.operating_system_id = (SELECT id FROM operating_systems WHERE name='".$filter->getOperatingSystem()."')"."\n";
        }
        if($filter->getPlayVersion()) {
            $query.="INNER JOIN casinos__play_versions AS t9 ON t1.id = t9.casino_id AND t9.play_version_id = (SELECT id FROM play_versions WHERE name='".$filter->getPlayVersion()."')"."\n";
        }
        if($filter->getSoftware()) {
            $query.="INNER JOIN casinos__game_manufacturers AS t10 ON t1.id = t10.casino_id AND t10.game_manufacturer_id = (SELECT id FROM game_manufacturers WHERE name='".$filter->getSoftware()."')"."\n";
        }
        if($filter->getGame()) {
            $query.="INNER JOIN casinos__game_manufacturers AS t10 ON t1.id = t10.casino_id AND t10.game_manufacturer_id = (SELECT id FROM game_manufacturers WHERE name='".$filter->getSoftware()."')"."\n";
        }
        $query.="WHERE t1.is_open = 1 AND ";
        if($filter->getHighRoller()) {
            $query.="t1.is_high_roller = 1 AND ";
        }
        if($filter->getPromoted()) {
            $query.="t1.status_id = 0 AND ";
        }
        if($filter->getCasinoLabel()=="New") {
            $query.="t1.date_established > DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND ";
        }
        $query = substr($query,0, -4)."\n";
        if($sortBy) {
            $order = "";
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
                    $filter->setPromoted(TRUE);
                    break;
            }
            $query.=$order;
        }

        if(!empty($limit)) {
            $query .= " LIMIT " . $limit;
        }

        if(!empty($offset))
            $query .= !empty($offset) ? ' OFFSET ' . $offset : '';

        $this->query = $query;
    }


    public function getQuery() {
        return $this->query;
    }
}