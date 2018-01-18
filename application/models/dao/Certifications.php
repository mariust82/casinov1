<?php
/**
 * Created by PhpStorm.
 * User: aherne
 * Date: 18.01.2018
 * Time: 15:25
 */

class Certifications
{
    public function getNumberOfCasinos($certification) {
        return DB("
        SELECT
        count(*) as counter
        FROM certifications AS t1
        INNER JOIN casinos__certifications AS t2 ON t1.id = t2.certification_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t1.name = :name AND t3.is_open = 1
        ", array(":name"=>$certification))->toValue();
    }
}