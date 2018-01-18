<?php
/**
 * Created by PhpStorm.
 * User: aherne
 * Date: 18.01.2018
 * Time: 15:31
 */

class Casinos
{
    public function getHighRollerNumber() {
        return (integer) DB("SELECT count(*) AS nr FROM casinos WHERE is_high_roller=1")->toValue();
    }
}