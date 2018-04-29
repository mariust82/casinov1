<?php
require_once("CasinoCounter.php");
require_once("FieldValidator.php");

class CasinoLabels implements CasinoCounter, FieldValidator
{
    public function getCasinosCount() {
        return DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM casino_labels AS t1
        INNER JOIN casinos__labels AS t2 ON t1.id = t2.label_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1 AND t1.id != 8
        GROUP BY t1.id
        ORDER BY counter DESC 
        ")->toMap("unit","counter");
    }

    public function validate($name) {
        return DB("SELECT name FROM casino_labels WHERE name=:name",array(":name"=>$name))->toValue();
    }
}