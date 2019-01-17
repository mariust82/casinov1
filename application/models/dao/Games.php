<?php
/**
 * Created by PhpStorm.
 * User: aherne
 * Date: 25.01.2018
 * Time: 17:48
 */

class Games
{
    public function incrementTimesPlayed($id) {
        return DB("UPDATE games SET times_played = times_played + 1 WHERE id=:id",array(":id"=>$id))->getAffectedRows();
    }

    public function getAll() {
        return DB("SELECT name FROM games ORDER BY name ASC")->toColumn();
    }
}