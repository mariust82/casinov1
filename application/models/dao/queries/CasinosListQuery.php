<?php

require_once("vendor/lucinda/queries/plugins/MySQL/MySQLSelect.php");
require_once("application/models/dao/BestCasinoLabel.php");

use Lucinda\Query\MySQLComparisonOperator;
use Lucinda\Query\MySQLCondition;
use Lucinda\Query\MySQLSelect;
use Lucinda\Query\Select;
use MongoDB\Driver\Query;

class CasinosListQuery
{
    const CASINO_SCORE = 7.5;
    const CASINO_MIN_VOTES = 10;
    private $query;

    public function __construct(CasinoFilter $filter, $columns, $sortBy=null, $limit= 0, $offset='')
    {
        $this->setQuery($filter, $columns, $sortBy, $limit, $offset);
    }

    private function setQuery(CasinoFilter $filter, $columns, $sortBy, $limit= 0, $offset)
    {
        $query = new Lucinda\Query\MySQLSelect("casinos", "t1");
        $this->setFields($query, $columns, $filter);
        $this->setSelect($query, $filter);
        $this->setWhere($query->where(), $filter);
        $this->setOrderBy($query->orderBy(), $filter, $sortBy);
        $this->setGroupBy($query,$filter,$limit);
        $this->setLimit($query, $filter, $limit, $offset);
        $this->query = $query->toString();
    }

    private function setGroupBy(Lucinda\Query\MySQLSelect $query, CasinoFilter $filter,$limit) {
        if ($limit > 0 && $filter->getPlayVersion() == "Live Dealer") {
            $query->groupBy(['t1.id']);
        }
    }

    private function setFields(Lucinda\Query\MySQLSelect $query, $columns, CasinoFilter $filter)
    {
        $fields = $query->fields($columns);
        $fields->add('(CASE
                 WHEN t1.status_id = 0  THEN 1
                 WHEN t1.status_id = 3  THEN 2
                 WHEN t1.status_id = 2  THEN 3
                 WHEN t1.status_id = 1  THEN 4
                 END)', 'complex_case');
        if ($filter->getBankingMethod()) {
            if (sizeof($columns) > 1) {
                $fields->add("t3.id", "has_dm");
                $fields->add("t14.id", "has_wm");
            }
        }
        
        if ($filter->getCasinoLabel() == 'Fast Payout') {
            $fields->add("t18.end");
        }
    }

    private function setSelect(Lucinda\Query\MySQLSelect $query, CasinoFilter $filter)
    {
        if ($filter->getCurrencyAccepted()) {
            $query->joinInner("casinos__currencies", "t15")->on(["t1.id" => "t15.casino_id","t15.currency_id" => $filter->currency_id."\n"]);
        } else {
            $query->joinLeft("casinos__currencies", "t15")->on(["t1.id" => "t15.casino_id"]);
        }

        if ($filter->getLanguageAccepted()) {
            $query->joinInner("casinos__languages", "t16")->on(["t1.id" => "t16.casino_id","t16.language_id" => $filter->language_id."\n"]);
        }

        if ($filter->getCountryAccepted()) {
            $query->joinInner("casinos__countries_allowed", "t2")->on(["t1.id" => "t2.casino_id","t2.country_id"=>$filter->getDetectedCountry()->id . "\n"]);
        } else {
            $query->joinLeft("casinos__countries_allowed", "t2")->on(["t1.id" => "t2.casino_id","t2.country_id" => $filter->getDetectedCountry()->id . "\n"]);
        }
        if ($filter->getBankingMethod()) {
            $banking_method_id = $this->getBankingNameMethod($filter->getBankingMethod());
            $query->joinLeft("casinos__deposit_methods", "t3")->on(["t1.id" => "t3.casino_id","t3.banking_method_id" => $banking_method_id ]);
            $query->joinLeft("casinos__withdraw_methods", "t14")->on(["t1.id" => "t14.casino_id","t14.banking_method_id" => $banking_method_id]);
        }
        if ($filter->getBonusType() || $filter->getFreeBonus()) {
            $condition =  $query->joinInner("casinos__bonuses", "t4")->on();
            $condition->set("t1.id", "t4.casino_id");
            if ($filter->getBonusType() && in_array(strtolower($filter->getBonusType()), array("free spins","no deposit bonus"))) {
                // free bonus is no longer relevant
                $sub_query = new Lucinda\Query\MySQLSelect("bonus_types");
                $sub_query->fields(["id"]);
                $sub_query->where(["name" => "'".$filter->getBonusType()."'"]);
                $condition->set("t4.bonus_type_id", "(".$sub_query->toString() . ")");
            } else {
                if ($filter->getBonusType()) {
                    $sub_query = new Lucinda\Query\MySQLSelect("bonus_types");
                    $sub_query->fields(["id"]);
                    $sub_query->where(["name" => "'".$filter->getBonusType()."'"]);
                    $condition->set("t4.bonus_type_id", "(" . $sub_query->toString() . ")");
                }
                if ($filter->getFreeBonus()) {
                    $condition->setIn("t4.bonus_type_id", [3,4,5,6,11]);
                }
            }
        }

        if ($filter->getCasinoLabel()) {
            if ($filter->getCasinoLabel() == 'Blacklisted Casinos') {
                $filter->setPromoted(false);
            }
            
            if ($filter->getCasinoLabel() == 'Fast Payout') {
                $query->joinInner("casinos__withdraw_timeframes ", "t18")->on(["t1.id" => "t18.casino_id"])->set("t18.unit","'hour'")->set("t18.end",24,Lucinda\Query\ComparisonOperator::LESSER_EQUALS);
            }
            
            if (!in_array($filter->getCasinoLabel(), ["New", "all", "Best", 'Fast Payout'])) {
                $sub_query = new Lucinda\Query\MySQLSelect("casino_labels");
                $sub_query->fields(["id"]);
                $sub_query->where(["name"=> "'". $filter->getCasinoLabel() . "'"]);
                $query->joinInner("casinos__labels", "t5")->on(["t1.id" => "t5.casino_id", "t5.label_id" =>  "(" . $sub_query->toString() . ")" ]);
            }
        }
        if ($filter->getCertification()) {
            $sub_query = new Lucinda\Query\MySQLSelect("certifications");
            $sub_query->fields(["id"]);
            $sub_query->where(["name"=> "'".$filter->getCertification()."'"]);
            $query->joinInner("casinos__certifications", "t6")->on(["t1.id" => "t6.casino_id","t6.certification_id" => "(". $sub_query->toString() . ")"]);
        }
        if ($filter->getCountry()) {
            $sub_query = new Lucinda\Query\MySQLSelect("countries");
            $sub_query->fields(["id"]);
            $sub_query->where(["name" => "'". $filter->getCountry(). "'"]);
            $query->joinInner("casinos__countries_allowed", "t7")->on(["t1.id" => "t7.casino_id","t7.country_id" => "(". $sub_query->toString().")"]);
        }
        if ($filter->getOperatingSystem()) {
            $sub_query = new Lucinda\Query\MySQLSelect("operating_systems");
            $sub_query->fields(["id"]);
            $sub_query->where(["name" => "'" . $filter->getOperatingSystem() . "'"]);
            $query->joinInner("casinos__operating_systems", "t8")->on(["t1.id" => "t8.casino_id" , "t8.casino_id" => "(" . $sub_query->toString()  . ")" ]);
        }
        if ($filter->getPlayVersion()) {
            if (!empty($filter->getPlayVersionType())) {
                $query->joinInner("casinos__game_types", "t11")->on(["t11.casino_id" => "t1.id"]);
                $query->joinInner("game_types", "t12")->on(["t12.id" => "t11.game_type_id"]);
            } else {
                $sub_query = new Lucinda\Query\MySQLSelect("play_versions");
                $sub_query->fields(["id"]);
                $sub_query->where(["name" => "'" . $filter->getPlayVersion() . "'"]);
                $query->joinInner("casinos__play_versions", "t9")->on(["t1.id" => "t9.casino_id" , "t9.play_version_id" => "(" . $sub_query->toString()  . ")" ]);
                if ($filter->getPlayVersion() == "Live Dealer") {
                    $query->joinInner("casinos__game_types", "t14")->on(["t14.casino_id" => "t1.id"])->set("t14.is_live", 1);
                    $query->joinInner("game_types", "t15")->on(["t15.id" => "t14.game_type_id"]);
                }
            }
        }
        if ($filter->getSoftware()) {
            $sub_query = new Lucinda\Query\MySQLSelect("game_manufacturers");
            $sub_query->fields(["id"]);
            $sub_query->where(["name" => "'" .$filter->getSoftware() ."'" ]);
            $query->joinInner("casinos__game_manufacturers", "t10")->on(["t1.id" => "t10.casino_id","t10.game_manufacturer_id" => "(". $sub_query->toString() . ")"]);
        }
        if ($filter->getGame()) {
            $sub_query = new Lucinda\Query\MySQLSelect("game_manufacturers");
            $sub_query->fields(["id"]);
            $sub_query->where(["name" => "'" . $filter->getSoftware() . "'"]);
            $query->joinInner("casinos__game_manufacturers", "t10")->on(["t1.id" => "t10.casino_id", "t10.game_manufacturer_id" => "(" . $sub_query->toString() . ")" ]);
        }
    }

    private function setWhere(Lucinda\Query\Condition $where, CasinoFilter $filter)
    {
        $where->set("t1.is_open", 1);

        if ($filter->getHighRoller()) {
            $where->set("t1.is_high_roller", 1);
        }
        if ($filter->getPromoted()) {
            $where->set("t1.status_id", 0);
        }

        switch ($filter->getCasinoLabel()) {
            case 'New':
                $where->set("t1.date_established", "'".date("Y-m-d", strtotime(date("Y-m-d")." -1 year"))."'", Lucinda\Query\ComparisonOperator::GREATER);
                break;
            case "Best":
                $this->addBestCondition($where);
                break;
        }

        if ($filter->getBankingMethod()) {
            $group = new Lucinda\Query\Condition(array(), Lucinda\Query\LogicalOperator::_OR_);
            $group->set('t3.id', null, MySQLComparisonOperator::IS_NOT_NULL);
            $group->set('t14.id', null, MySQLComparisonOperator::IS_NOT_NULL);
            $where->setGroup($group);
        }

        if (!empty($filter->getPlayVersionType())) {
            $where->set("t11.is_live", 1);
            $where->set("t12.name", "'".$filter->getPlayVersionType()."'");
        }
    }

    /**
     * Add the conditions for "Best Casinos page":
     * Display open casinos that are not closed/ blacklisted/ warning (Brand Admin - Status)
     * Display casinos that are on the market for at least 6 months (Brand Admin - Established)
     * The casino score should be 7.5 and above, out of at least 10 votes
     *
     * @param \Lucinda\Query\Condition $where
     */
    private function addBestCondition(Lucinda\Query\Condition $where)
    {
        $where->setIn("t1.status_id", [0, 3]);
        $where->set("t1.date_established", "'" . date("Y-m-d", strtotime(date("Y-m-d") . " -6 months")) . "'", Lucinda\Query\ComparisonOperator::LESSER_EQUALS);
        $where->set("t1.rating_votes", self::CASINO_MIN_VOTES, Lucinda\Query\ComparisonOperator::GREATER_EQUALS);
        $where->set("(t1.rating_total/t1.rating_votes)", self::CASINO_SCORE, Lucinda\Query\ComparisonOperator::GREATER_EQUALS);
    }

    private function setOrderBy(Lucinda\Query\OrderBy $orderBy, CasinoFilter $filter, $sortBy)
    {
        if ($sortBy) {
            switch ($sortBy) {
                case CasinoSortCriteria::NEWEST:
//                    $orderBy->add('complex_case', 'ASC');
                    $orderBy->add("t1.date_established", "DESC");
                    $orderBy->add("t1.priority", "DESC");
                    $orderBy->add("t1.id", "DESC");
                    break;
                case CasinoSortCriteria::DATE_ADDED:
                    $orderBy->add('complex_case', 'ASC');
                    $orderBy->add("t1.date_added", "DESC");
                    $orderBy->add("t1.priority", "DESC");
                    $orderBy->add("t1.id", "DESC");
                    break;
                case CasinoSortCriteria::TOP_RATED:
                    $orderBy->add('complex_case', 'ASC');
                    $orderBy->add("average_rating", "DESC");
                    $orderBy->add("t1.priority", "DESC");
                    $orderBy->add("t1.id", "DESC");
                    break;
                case CasinoSortCriteria::POPULARITY:
                    $orderBy->add('complex_case', 'ASC');
                    $orderBy->add("t1.clicks", "DESC");
                    $orderBy->add("t1.id", "DESC");
                    break;
                case CasinoSortCriteria::WAGERING:
                    $orderBy->add("t5.id", "ASC");
                    break;
                case CasinoSortCriteria::NO_ACCOUNT:
                    $orderBy->add("t1.priority", "DESC");
                    $orderBy->add("t1.date_established", "DESC");
                    $orderBy->add("t1.id", "DESC");
                    break;
                case CasinoSortCriteria::FAST_PAYOUT:
                    $orderBy->add("t18.end", "ASC");
                    $orderBy->add("t1.priority", "DESC");
                    break;
                default:
                    $orderBy->add('complex_case', 'ASC');
                    $orderBy->add("t1.priority", "DESC");
                    $orderBy->add("t1.id", "DESC");
                    $filter->setPromoted(true);
                    break;
            }
        }
    }

    public function getQuery()
    {
        return $this->query;
    }

    private function getBankingNameMethod($name)
    {
        $query = "Select id from banking_methods  where name = '" . $name. "'";
        $result = SQL($query);
        $row = $result->toRow();
        return $row['id'];
    }

    private function setLimit(Lucinda\Query\MySQLSelect $query, CasinoFilter $filter, $limit, $offset)
    {
        if (!empty($limit)) {
            $query->limit($limit, $offset);
        }
    }
}
