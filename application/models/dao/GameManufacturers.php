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
    
    public function getAllByGameType($is_mobile,$type)
    {
        $feature_id = $is_mobile == TRUE ? 7 : 8;
        $mobile = $is_mobile == TRUE ? 1 : 0;
        return SQL("
        SELECT DISTINCT t2.name
        FROM games AS t1
        INNER JOIN game_manufacturers AS t2 ON t1.game_manufacturer_id = t2.id
        INNER JOIN game_types AS t3 ON t1.game_type_id = t3.id AND t3.name = :type
        INNER JOIN game_play__matches AS t6 ON t1.id = t6.game_id
        INNER JOIN game_play__patterns AS t7 ON t7.id = t6.pattern_id AND t7.isMobile IN ({$mobile},2)
        INNER JOIN games__features AS t8 ON t1.id = t8.game_id AND t8.feature_id = {$feature_id}
        WHERE t2.is_open = 1 AND t1.is_open = 1
        ", [':type' => $type])->toColumn();
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
