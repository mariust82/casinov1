<?php
/**
 * Created by PhpStorm.
 * User: aherne
 * Date: 25.01.2018
 * Time: 17:48
 */

class Games
{
    public function incrementTimesPlayed($name) {
        return DB("UPDATE games SET times_played = times_played + 1 WHERE name=:name",array(":name"=>$name))->getAffectedRows();
    }
}