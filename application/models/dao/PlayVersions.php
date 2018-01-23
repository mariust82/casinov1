<?php
require_once("CasinoCounter.php");
require_once("FieldValidator.php");

class PlayVersions implements CasinoCounter
{
    public function getCasinosCount() {
        return DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM play_versions AS t1
        INNER JOIN casinos__play_versions AS t2 ON t1.id = t2.play_version_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t1.name IN ('Flash','Mobile') AND t3.is_open = 1
        GROUP BY t1.id
        ORDER BY counter DESC
        ")->toMap("unit","counter");
    }

    public function getNumberOfCasinos($playVersionName) {
        return DB("
        SELECT
        count(*) as counter
        FROM play_versions AS t1
        INNER JOIN casinos__play_versions AS t2 ON t1.id = t2.play_version_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t1.name = :name AND t3.is_open = 1
        ", array(":name"=>$playVersionName))->toValue();
    }

    public function validate($name)
    {
        return DB("SELECT name FROM play_versions WHERE name=:name",array(":name"=>$name))->toValue();
    }
}