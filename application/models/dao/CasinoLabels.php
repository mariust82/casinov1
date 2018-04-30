<?php
require_once("CasinoCounter.php");
require_once("FieldValidator.php");

class CasinoLabels implements CasinoCounter, FieldValidator
{
    public function getCasinosCount() {
        $labels =  DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM casino_labels AS t1
        INNER JOIN casinos__labels AS t2 ON t1.id = t2.label_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1 AND t1.id != 8
        GROUP BY t1.id
        ORDER BY counter DESC 
        ")->toMap("unit","counter");
        
        $mobile =  DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM play_versions AS t1
        INNER JOIN casinos__play_versions AS t2 ON t1.id = t2.play_version_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1 AND t1.id = 4 OR t1.id = 2
        GROUP BY t1.id
        ORDER BY counter DESC 
        ")->toMap("unit","counter");
        $array = array_merge($labels,$mobile);
        
        $features =  DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM certifications AS t1
        INNER JOIN casinos__certifications AS t2 ON t1.id = t2.certification_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1 AND t1.id = 6
        GROUP BY t1.id
        ORDER BY counter DESC 
        ")->toMap("unit","counter");
        
        return array_merge($array,$features);
    }

    public function validate($name) {
        return DB("SELECT name FROM casino_labels WHERE name=:name",array(":name"=>$name))->toValue();
    }
}