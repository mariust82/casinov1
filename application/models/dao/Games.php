<?php
/**
 * Created by PhpStorm.
 * User: aherne
 * Date: 25.01.2018
 * Time: 17:48
 */

class Games
{
    public function incrementTimesPlayed($id)
    {
        return SQL("UPDATE games SET times_played = times_played + 1 WHERE id=:id", array(":id"=>$id))->getAffectedRows();
    }

    public function getAll()
    {
        return SQL("SELECT name FROM games ORDER BY date_launched DESC,id DESC")->toColumn();
    }
}
