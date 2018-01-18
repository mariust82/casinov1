<?php
/**
 * Created by PhpStorm.
 * User: aherne
 * Date: 18.01.2018
 * Time: 12:38
 */

class BonusTypes
{
    public function getAllByNumberOfCasinos() {
        return DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM bonus_types AS t1
        INNER JOIN casinos__bonuses AS t2 ON t1.id = t2.bonus_type_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t1.name IN ('Free Play', 'Free Spins', 'No Deposit Bonus') AND t3.is_open = 1
        GROUP BY t1.id
        ORDER BY counter DESC 
        ")->toMap("unit","counter");
    }
}