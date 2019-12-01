<?php
require_once("CasinoCounter.php");
require_once("FieldValidator.php");

class GameManufacturers implements CasinoCounter
{
    public function getCasinosCount()
    {
        return SQL("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM game_manufacturers AS t1
        INNER JOIN casinos__game_manufacturers AS t2 ON t1.id = t2.game_manufacturer_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1
        GROUP BY t1.id
        ORDER BY sort DESC, counter DESC 
        ")->toMap("unit", "counter");
    }

    public function getAll()
    {
        return SQL("
        SELECT DISTINCT t1.name
        FROM game_manufacturers AS t1
        INNER JOIN casinos__game_manufacturers AS t2 ON t1.id = t2.game_manufacturer_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1
        ORDER BY t1.name ASC 
        ")->toColumn();
    }
    
    public function getAllByGameType($type)
    {
        return SQL("
        SELECT DISTINCT t1.name
        FROM game_manufacturers AS t1
        INNER JOIN casinos__game_manufacturers AS t2 ON t1.id = t2.game_manufacturer_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        INNER JOIN games AS t4 ON(t4.game_manufacturer_id = t1.id)
        INNER JOIN game_types AS t5 ON(t4.game_type_id = t5.id) AND t5.name = :type
        WHERE t3.is_open = 1
        ORDER BY t1.name ASC 
        ",[':type'=>$type])->toColumn();
    }

    public function getSoftwareByType()
    {
        return SQL("
        SELECT name AS unit
        FROM game_manufacturers
        ")->toMap("unit", "unit");
    }

    public function getGameManufactures($id)
    {
        return SQL("SELECT name FROM game_manufacturers WHERE id=:id", array(":id"=>$id))->toValue();
    }
}
