<?php
require_once("CasinoCounter.php");
require_once("FieldValidator.php");

class GameManufacturers implements CasinoCounter
{
    public function getCasinosCount() {
        return DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM game_manufacturers AS t1
        INNER JOIN casinos__game_manufacturers AS t2 ON t1.id = t2.game_manufacturer_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1
        GROUP BY t1.id
        ORDER BY sort DESC, counter DESC 
        ")->toMap("unit","counter");
    }

    public function getAll() {
        return DB("
        SELECT DISTINCT t1.name
        FROM game_manufacturers AS t1
        INNER JOIN casinos__game_manufacturers AS t2 ON t1.id = t2.game_manufacturer_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1
        ORDER BY t1.name ASC 
        ")->toColumn();
    }

    public function getSoftwareByType() {
        return DB("
        SELECT name AS unit
        FROM game_manufacturers
        ")->toMap("unit", "unit");
    }
}