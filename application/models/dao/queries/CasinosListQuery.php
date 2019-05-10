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
    private $query;

    public function __construct(CasinoFilter $filter, $columns, $sortBy=null, $limit= 0 , $offset='')
    {
        $this->setQuery($filter, $columns, $sortBy, $limit , $offset);
    }

    private function setQuery(CasinoFilter $filter, $columns, $sortBy,  $limit= 0 , $offset) {
        $query = new Lucinda\Query\MySQLSelect("casinos","t1");
        $this->setFields($query,$columns, $filter);
        $this->setSelect($query,$filter);
        $this->setWhere($query->where(),$filter);
        $this->setOrderBy($query->orderBy(),$filter,$sortBy);
        $this->setLimit($query,$filter,$limit,$offset);
        $this->query = $query->toString();
    }

    private function setFields(Lucinda\Query\MySQLSelect $query, $columns, CasinoFilter $filter)
    {
        $fields = $query->fields($columns);
        $fields->add('(CASE
                 WHEN t1.status_id = 0  THEN 1
                 WHEN t1.status_id = 3  THEN 2
                 WHEN t1.status_id = 2  THEN 3
                 WHEN t1.status_id = 1  THEN 4
                 END)', 'complex_case' );
        if($filter->getBankingMethod()){
            if(sizeof($columns) > 1) {
                $fields->add("t3.id", "has_dm");
                $fields->add("t14.id", "has_wm");
            }
        }
    }

    private function setSelect(Lucinda\Query\MySQLSelect $query, CasinoFilter $filter)
    {
        if ($filter->getCurrencyAccepted()) {
            $query->joinInner("casinos__currencies","t15")->on(["t1.id" => "t15.casino_id","t15.currency_id" => $filter->currency_id."\n"]);
        }

        if($filter->getLanguageAccepted()) {
            $query->joinInner("casinos__languages","t16")->on(["t1.id" => "t16.casino_id","t16.language_id" => $filter->language_id."\n"]);
        }

        if($filter->getCountryAccepted()) {
            $query->joinInner("casinos__countries_allowed","t2")->on(["t1.id" => "t2.casino_id","t2.country_id"=>$filter->getDetectedCountry()->id . "\n"]);
        }
        else {
            $query->joinLeft("casinos__countries_allowed","t2")->on(["t1.id" => "t2.casino_id","t2.country_id" => $filter->getDetectedCountry()->id . "\n"]);
        }
        if($filter->getBankingMethod()) {
            $banking_method_id = $this->getBankingNameMethod($filter->getBankingMethod());
            $query->joinLeft("casinos__deposit_methods","t3")->on(["t1.id" => "t3.casino_id","t3.banking_method_id" => $banking_method_id ]);
            $query->joinLeft("casinos__withdraw_methods","t14")->on(["t1.id" => "t14.casino_id","t14.banking_method_id" => $banking_method_id]);
        }
        if($filter->getBonusType() || $filter->getFreeBonus()) {
            $condition =  $query->joinInner("casinos__bonuses", "t4")->on();
            $condition->set("t1.id", "t4.casino_id");
            if($filter->getBonusType() && in_array(strtolower($filter->getBonusType()),array("free spins","no deposit bonus"))) {
                // free bonus is no longer relevant
                $sub_query = new Lucinda\Query\MySQLSelect("bonus_types");
                $sub_query->fields(["id"]);
                $sub_query->where(["name" => "'".$filter->getBonusType()."'"]);
                $condition->set("t4.bonus_type_id","(".$sub_query->toString() . ")");
            }
            else {
                if($filter->getBonusType())
                {
                    $sub_query = new Lucinda\Query\MySQLSelect("bonus_types");
                    $sub_query->where(["name" => "'".$filter->getBonusType()."'"]);
                    $condition->set("t4.bonus_type_id","(" . $sub_query->toString() . ")");
                }
                if($filter->getFreeBonus())
                {
                    $condition->setIn("t4.bonus_type_id",[3,4,5,6,11]);
                }
            }
        }

        if($filter->getCasinoLabel())
        {
            if ($filter->getCasinoLabel() == "Stay away") {
                $filter->setPromoted(FALSE);
            }
            if ($filter->getCasinoLabel() == 'Low Wagering')
            {
                $query->joinInner("casinos__bonuses","t11")->on(["t1.id" => "t11.casino_id" ]);
            }
            else if(($filter->getCasinoLabel() != "New")) {
                $sub_query = new Lucinda\Query\MySQLSelect("casino_labels");
                $sub_query->fields(["id"]);
                $sub_query->where(["name"=> "'". $filter->getCasinoLabel() . "'"]);
                $query->joinInner("casinos__labels","t5")->on(["t1.id" => "t5.casino_id", "t5.label_id" =>  "(" . $sub_query->toString() . ")" ]);
            }
        }
        if($filter->getCertification()) {
            $sub_query = new Lucinda\Query\MySQLSelect("certifications");
            $sub_query->fields(["id"]);
            $sub_query->where(["name"=> "'".$filter->getCertification()."'"]);
            $query->joinInner("casinos__certifications","t6")->on(["t1.id" => "t6.casino_id","t6.certification_id" => "(". $sub_query->toString() . ")"]);
        }
        if($filter->getCountry()) {
            $sub_query = new Lucinda\Query\MySQLSelect("countries");
            $sub_query->fields(["id"]);
            $sub_query->where(["name" => "'". $filter->getCountry(). "'"]);
            $query->joinInner("casinos__countries_allowed","t7")->on(["t1.id" => "t7.casino_id","t7.country_id" => "(". $sub_query->toString().")"]);
        }
        if($filter->getOperatingSystem()) {
            $sub_query = new Lucinda\Query\MySQLSelect("operating_systems");
            $sub_query->fields(["id"]);
            $sub_query->where(["name" => "'" . $filter->getOperatingSystem() . "'"]);
            $query->joinInner("casinos__operating_systems","t8")->on(["t1.id" => "t8.casino_id" , "t8.casino_id" => "(" . $sub_query->toString()  . ")" ]);
        }
        if($filter->getPlayVersion()) {
            $sub_query = new Lucinda\Query\MySQLSelect("play_versions");
            $sub_query->fields(["id"]);
            $sub_query->where(["name" => "'" . $filter->getPlayVersion() . "'"]);
            $query->joinInner("casinos__play_versions","t9")->on(["t1.id" => "t9.casino_id" , "t9.play_version_id" => "(" . $sub_query->toString()  . ")" ]);
        }
        if($filter->getSoftware()) {
            $sub_query = new Lucinda\Query\MySQLSelect("game_manufacturers");
            $sub_query->fields(["id"]);
            $sub_query->where(["name" => "'" .$filter->getSoftware() ."'" ]);
            $query->joinInner("casinos__game_manufacturers","t10")->on(["t1.id" => "t10.casino_id","t10.game_manufacturer_id" => "(". $sub_query->toString() . ")"]);
        }
        if($filter->getGame()) {
            $sub_query = new Lucinda\Query\MySQLSelect("game_manufacturers");
            $sub_query->fields(["id"]);
            $sub_query->where(["name" => "'" . $filter->getSoftware() . "'"]);
            $query->joinInner("casinos__game_manufacturers","t10")->on(["t1.id" => "t10.casino_id", "t10.game_manufacturer_id" => "(" . $sub_query->toString() . ")" ]);
        }
    }

    private function setWhere(Lucinda\Query\Condition $where, CasinoFilter $filter)
    {
        $where->set("t1.is_open" ,1);

        if($filter->getHighRoller()) {
            $where->set("t1.is_high_roller",1);
        }
        if($filter->getPromoted()) {
            $where->set("t1.status_id",0);
        }
        if($filter->getCasinoLabel()=="New") {
            $where->set("t1.date_established","DATE_SUB(CURDATE(), INTERVAL 1 YEAR )",Lucinda\Query\ComparisonOperator::GREATER);
        }
        elseif($filter->getCasinoLabel()=="Best")
        {
            $obj = new BestCasinoLabel();
            $where->set("t1.status_id", $obj->getBestCriteria());
           // $where->set("t1.rating_total/t1.rating_votes", 8, Lucinda\Query\ComparisonOperator::GREATER_EQUALS);
        }
        if($filter->getBankingMethod())
        {
            $group = new Lucinda\Query\Condition(array(), Lucinda\Query\LogicalOperator::_OR_);
            $group->set('t3.id', null,MySQLComparisonOperator::IS_NOT_NULL);
            $group->set('t14.id', null,MySQLComparisonOperator::IS_NOT_NULL);
            $where->setGroup($group);
        }
        if($filter->getCasinoLabel()=="Low Wagering")
        {
            $where->set("t1.status_id",1,MySQLComparisonOperator::DIFFERS);
           // $where->set("t11.bonus_type_id",8);
            $where->setIn("t11.bonus_type_id",[3,4,5,6]);
            $where->set('CAST(t11.wagering as UNSIGNED)',"'26'",MySQLComparisonOperator::LESSER);
        }
    }

    private function setOrderBy(Lucinda\Query\OrderBy $orderBy,CasinoFilter $filter, $sortBy)
    {
        if($sortBy)
        {
            $orderBy->add('complex_case', 'ASC' );

            switch($sortBy) {
                case CasinoSortCriteria::NEWEST:
                    $orderBy->add("t1.date_established" , "DESC");
                    $orderBy->add("t1.priority" , "DESC");
                    $orderBy->add("t1.id" , "DESC");
                    break;
                case CasinoSortCriteria::TOP_RATED:
                    $orderBy->add("average_rating" , "DESC");
                    $orderBy->add("t1.priority" , "DESC");
                    $orderBy->add("t1.id" , "DESC");
                    break;
                case CasinoSortCriteria::POPULARITY:
                    $orderBy->add("t1.clicks" , "DESC");
                    $orderBy->add("t1.id" , "DESC");
                    break;
                case CasinoSortCriteria::WAGERING:
                    $orderBy->add("CAST(t11.wagering as UNSIGNED)","ASC");
                    $orderBy->add("t1.priority" , "DESC");
                    $orderBy->add("t1.id" , "DESC");
                    break;
                default:
                    $orderBy->add("t1.priority" , "DESC");
                    $orderBy->add("t1.id" , "DESC");
                    $filter->setPromoted(TRUE);
                    break;
            }
        }
    }

    public function getQuery() {
        return $this->query;
    }

    private function getBankingNameMethod($name)
    {
        $query = "Select id from banking_methods  where name = '" . $name. "'";
        $result = SQL($query);
        $row = $result->toRow();
        return $row['id'];
    }

    private function setLimit(Lucinda\Query\MySQLSelect $query, CasinoFilter $filter, $limit , $offset)
    {
        if(!empty($limit))
        {
            if($filter->getCasinoLabel() == 'Best')
            {
                $obj = new BestCasinoLabel();
                $limit = $obj->getBestLimit();
            }
            $query->limit($limit,$offset);
        }
    }
}