<?php

require_once("vendor/lucinda/queries/plugins/MySQL/MySQLSelect.php");

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
        $this->setFields($query,$columns);
        $this->setSelect($query,$filter);
        $this->setWhere($query->where(),$filter);
        $this->setOrderBy($query->orderBy(),$filter,$sortBy);
        if(!empty($limit))  //  $query .= !empty($limit) ? ' LIMIT ' . $limit : '';
        {
            //  $query .= ' LIMIT ' . $limit;
            $query->limit($limit,$offset);
        }
        $this->query = $query->toString();
    }

    private function setFields(Lucinda\Query\MySQLSelect $query, $columns)
    {
        //  $query->distinct();
        //$query->fields($columns);
        $query->fields($columns)->add('(CASE
                 WHEN t1.status_id = 0  THEN 1
                 WHEN t1.status_id = 3  THEN 2
                 WHEN t1.status_id = 2  THEN 3
                 WHEN t1.status_id = 1  THEN 4
                 END)', 'complex_case' );
    }

    private function setSelect(Lucinda\Query\MySQLSelect $query, CasinoFilter $filter)
    {
        if ($filter->getCurrencyAccepted()) {
            //   $query.="INNER JOIN casinos__currencies AS t15 ON t1.id = t15.casino_id AND t15.currency_id = ".$filter->currency_id."\n";
            $query->joinInner("casinos__currencies","t15")->on(["t1.id" => "t15.casino_id","t15.currency_id" => $filter->currency_id."\n"]);
        }

        if($filter->getLanguageAccepted()) {
            //   $query.="INNER JOIN casinos__languages AS t16 ON t1.id = t16.casino_id AND t16.language_id = ".$filter->language_id."\n";
            $query->joinInner("casinos__languages","t16")->on(["t1.id" => "t16.casino_id","t16.language_id" => $filter->language_id."\n"]);
        }

        if($filter->getCountryAccepted()) {
            //   $query.="INNER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id AND t2.country_id = ".$filter->getDetectedCountry()->id."\n";
            $query->joinInner("casinos__countries_allowed","t2")->on(["t1.id" => "t2.casino_id","t2.country_id"=>$filter->getDetectedCountry()->id . "\n"]);
        }
        else {
            //     $query.="LEFT JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id AND t2.country_id = ".$filter->getDetectedCountry()->id."\n";
            $query->joinLeft("casinos__countries_allowed","t2")->on(["t1.id" => "t2.casino_id","t2.country_id" => $filter->getDetectedCountry()->id . "\n"]);
        }
        if($filter->getBankingMethod()) {
            //    $query.="INNER JOIN casinos__deposit_methods AS t3 ON t1.id = t3.casino_id AND t3.banking_method_id = (SELECT id FROM banking_methods WHERE name='".$filter->getBankingMethod()."')"."\n";
            $sub_query = new Lucinda\Query\MySQLSelect("banking_methods");
            $sub_query->fields(["id"]);
            $sub_query->where(["name" => "'" . $filter->getBankingMethod() . "'"]);
            $query->joinInner("casinos__deposit_methods","t3")->on(["t1.id" => "t3.casino_id","t3.banking_method_id" => "(". $sub_query->toString() .")"]);
        }
        if($filter->getBonusType() || $filter->getFreeBonus()) {
            // $query.="INNER JOIN casinos__bonuses AS t4 ON t1.id = t4.casino_id AND ".$condition->toString()."\n";
            $condition =  $query->joinInner("casinos__bonuses", "t4")->on();
            $condition->set("t1.id", "t4.casino_id");
            if($filter->getBonusType() && in_array(strtolower($filter->getBonusType()),array("free spins","no deposit bonus"))) {
                // free bonus is no longer relevant
                // $condition = "t4.bonus_type_id = (SELECT id FROM bonus_types WHERE name='".$filter->getBonusType()."')";
                $sub_query = new Lucinda\Query\MySQLSelect("bonus_types");
                $sub_query->fields(["id"]);
                $sub_query->where(["name" => "'".$filter->getBonusType()."'"]);
                $condition->set("t4.bonus_type_id","(".$sub_query->toString() . ")");
            }
            else {
                /*   $condition = ($filter->getBonusType()?"t4.bonus_type_id = (SELECT id FROM bonus_types WHERE name='".$filter->getBonusType()."') AND ":"");
                     $condition .= ($filter->getFreeBonus()?"t4.bonus_type_id IN (3,4,5,6,11) AND ":"");
                     $condition = substr($condition,0,-4);*/
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
            if ($filter->getCasinoLabel() != "New") {
                //    $query.="INNER JOIN casinos__labels AS t5 ON t1.id = t5.casino_id AND t5.label_id = (SELECT id FROM casino_labels WHERE name='".$filter->getCasinoLabel()."')"."\n";
                $sub_query = new Lucinda\Query\MySQLSelect("casino_labels");
                $sub_query->fields(["id"]);
                $sub_query->where(["name"=> "'". $filter->getCasinoLabel() . "'"]);
                $query->joinInner("casinos__labels","t5")->on(["t1.id" => "t5.casino_id", "t5.label_id" =>  "(" . $sub_query->toString() . ")" ]);
            }
        }
        if($filter->getCertification()) {
            //$query.="INNER JOIN casinos__certifications AS t6 ON t1.id = t6.casino_id AND t6.certification_id = (SELECT id FROM certifications WHERE name='".$filter->getCertification()."')"."\n";
            $sub_query = new Lucinda\Query\MySQLSelect("certifications");
            $sub_query->fields(["id"]);
            $sub_query->where(["name"=> "'".$filter->getCertification()."'"]);
            $query->joinInner("casinos__certifications","t6")->on(["t1.id" => "t6.casino_id","t6.certification_id" => "(". $sub_query->toString() . ")"]);
        }
        if($filter->getCountry()) {
            //    $query.="INNER JOIN casinos__countries_allowed AS t7 ON t1.id = t7.casino_id AND t7.country_id = (SELECT id FROM countries WHERE name='".$filter->getCountry()."')"."\n";
            $sub_query = new Lucinda\Query\MySQLSelect("countries");
            $sub_query->fields(["id"]);
            $sub_query->where(["name" => "'". $filter->getCountry(). "'"]);
            $query->joinInner("casinos__countries_allowed","t7")->on(["t1.id" => "t7.casino_id","t7.country_id" => "(". $sub_query->toString().")"]);
        }
        if($filter->getOperatingSystem()) {
            //   $query.="INNER JOIN casinos__operating_systems AS t8 ON t1.id = t8.casino_id AND t8.operating_system_id = (SELECT id FROM operating_systems WHERE name='".$filter->getOperatingSystem()."')"."\n";
            $sub_query = new Lucinda\Query\MySQLSelect("operating_systems");
            $sub_query->fields(["id"]);
            $sub_query->where(["name" => "'" . $filter->getOperatingSystem() . "'"]);
            $query->joinInner("casinos__operating_systems","t8")->on(["t1.id" => "t8.casino_id" , "t8.casino_id" => "(" . $sub_query->toString()  . ")" ]);
        }
        if($filter->getPlayVersion()) {
            //  $query.="INNER JOIN casinos__play_versions AS t9 ON t1.id = t9.casino_id AND t9.play_version_id = (SELECT id FROM play_versions WHERE name='".$filter->getPlayVersion()."')"."\n";
            $sub_query = new Lucinda\Query\MySQLSelect("play_versions");
            $sub_query->fields(["id"]);
            $sub_query->where(["name" => "'" . $filter->getPlayVersion() . "'"]);
            $query->joinInner("casinos__play_versions","t9")->on(["t1.id" => "t9.casino_id" , "t9.play_version_id" => "(" . $sub_query->toString()  . ")" ]);
        }
        if($filter->getSoftware()) {
            //    $query.="INNER JOIN casinos__game_manufacturers AS t10 ON t1.id = t10.casino_id AND t10.game_manufacturer_id = (SELECT id FROM game_manufacturers WHERE name='".$filter->getSoftware()."')"."\n";
            $sub_query = new Lucinda\Query\MySQLSelect("game_manufacturers");
            $sub_query->fields(["id"]);
            $sub_query->where(["name" => "'" .$filter->getSoftware() ."'" ]);
            $query->joinInner("casinos__game_manufacturers","t10")->on(["t1.id" => "t10.casino_id","t10.game_manufacturer_id" => "(". $sub_query->toString() . ")"]);
        }
        if($filter->getGame()) {
            // $query.="INNER JOIN casinos__game_manufacturers AS t10 ON t1.id = t10.casino_id AND t10.game_manufacturer_id = (SELECT id FROM game_manufacturers WHERE name='".$filter->getSoftware()."')"."\n";
            $sub_query = new Lucinda\Query\MySQLSelect("game_manufacturers");
            $sub_query->fields(["id"]);
            $sub_query->where(["name" => "'" . $filter->getSoftware() . "'"]);
            $query->joinInner("casinos__game_manufacturers","t10")->on(["t1.id" => "t10.casino_id", "t10.game_manufacturer_id" => "(" . $sub_query->toString() . ")" ]);
        }
    }

    private function setWhere(Lucinda\Query\Condition $where, CasinoFilter $filter)
    {
        // $query.="WHERE t1.is_open = 1 AND ";
         $where->set("t1.is_open" ,1);

        if($filter->getHighRoller()) {
            //  $query.="t1.is_high_roller = 1";
            $where->set("t1.is_high_roller",1);
        }
        if($filter->getPromoted()) {
            //   $query.="t1.status_id = 0 AND ";
            $where->set("t1.status_id",0);
        }
        if($filter->getCasinoLabel()=="New") {
            //   $query.=" AND t1.date_established > DATE_SUB(CURDATE(), INTERVAL 1 YEAR) ";
            $where->set("t1.date_established","DATE_SUB(CURDATE(), INTERVAL 1 YEAR )",Lucinda\Query\ComparisonOperator::GREATER);
        }
        elseif($filter->getCasinoLabel()=="Best")
        {
            // $query.="t1.rating_total/t1.rating_votes > 4 AND";
            $where->set("t1.rating_total/t1.rating_votes",4,Lucinda\Query\ComparisonOperator::GREATER);
        }
        //  $query = substr($query->toString(),0, -4)."\n";
    }

    private function setOrderBy(Lucinda\Query\OrderBy $orderBy,CasinoFilter $filter, $sortBy)
    {

        if($sortBy)
        {
            /*   $order = "
                    ORDER BY
                   CASE
                     WHEN t1.status_id = 0  THEN 1
                     WHEN t1.status_id = 3  THEN 2
                     WHEN t1.status_id = 2  THEN 3
                     WHEN t1.status_id = 1  THEN 4
                     END ASC
                    ";*/
            $orderBy->add('complex_case', 'ASC' );

            switch($sortBy) {
                case CasinoSortCriteria::NEWEST:
                    //    $order .= " , t1.date_established DESC, t1.priority DESC, t1.id DESC";
                    $orderBy->add("t1.date_established" , "DESC");
                    $orderBy->add("t1.priority" , "DESC");
                    $orderBy->add("t1.id" , "DESC");
                    break;
                case CasinoSortCriteria::TOP_RATED:
                    //     $order .= " , average_rating DESC, t1.priority DESC, t1.id DESC ";
                    $orderBy->add("average_rating" , "DESC");
                    $orderBy->add("t1.priority" , "DESC");
                    $orderBy->add("t1.id" , "DESC");
                    break;
                case CasinoSortCriteria::POPULARITY:
                    //    $order .= " ,  t1.clicks DESC, t1.id DESC"."\n";
                    $orderBy->add("t1.clicks" , "DESC");
                    $orderBy->add("t1.id" , "DESC");
                    break;
                default:
                    //    $order .= " , t1.priority DESC, t1.id DESC"."\n";
                    $orderBy->add("t1.priority" , "DESC");
                    $orderBy->add("t1.id" , "DESC");
                    $filter->setPromoted(TRUE);
                    break;
            }
            //   $query.= $order;
        }
    }

    public function getQuery() {
        return $this->query;
    }
}