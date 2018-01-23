<?php
require_once("CasinoCounter.php");
require_once("FieldValidator.php");

class OperatingSystems implements CasinoCounter, FieldValidator
{
    public function getCasinosCount() {
        return DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM operating_systems AS t1
        INNER JOIN casinos__operating_systems AS t2 ON t1.id = t2.operating_system_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t1.name IN ('Android','iOS','Linux','Mac') AND  t3.is_open = 1
        GROUP BY t1.id
        ORDER BY counter DESC
        ")->toMap("unit","counter");
    }

    public function validate($name) {
        return DB("SELECT name FROM operating_systems WHERE name=:name",array(":name"=>$name))->toValue();
    }
}