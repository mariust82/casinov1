<?php
/**
 * Created by PhpStorm.
 * User: aherne
 * Date: 18.01.2018
 * Time: 10:39
 */

class GameManufacturers
{
    public function getAllByNumberOfCasinos() {
        return DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM game_manufacturers AS t1
        INNER JOIN casinos__game_manufacturers AS t2 ON t1.id = t2.game_manufacturer_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1
        GROUP BY t1.id
        ORDER BY counter DESC 
        ")->toMap("unit","counter");
    }
}