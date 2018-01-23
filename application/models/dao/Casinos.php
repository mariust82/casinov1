<?php
require_once("CasinoInfo.php");
require_once("FieldValidator.php");

class Casinos implements FieldValidator
{
    public function getHighRollerNumber() {
        return (integer) DB("SELECT count(*) AS nr FROM casinos WHERE is_high_roller=1")->toValue();
    }

    public function getInfo($name, $countryId) {
        $object = new CasinoInfo($name, $countryId);
        return $object->getResult();
    }

    public function getList(CasinoFilter $filter, $sortCriteria, $offset, $limit) {
        $object = new CasinosList($filter);
        $total = $object->getTotal();
        if($total>0) {
            return array("total"=>$total, "rows"=>$object->getResults($sortCriteria, $offset, $limit));
        } else {
            return array("total"=>0, "rows"=>array());
        }
    }

    public function validate($name) {
        return DB("SELECT name FROM casinos WHERE name=:name",array(":name"=>$name))->toValue();
    }
}