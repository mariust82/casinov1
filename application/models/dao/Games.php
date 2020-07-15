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
        return SQL("SELECT name, date FROM games ORDER BY date_launched DESC,id DESC")->toMap("name", "date");
    }

    public function getAllItems(){
        $res =  SQL("SELECT name, date FROM games ORDER BY date_launched DESC, id DESC")->toColumn();
        var_dump($res);
        die();
        $output = [];
        foreach($res as $value){
            $arr = explode(' ', $value);
            $output[] = $arr[0];
        }

        return $output;
    }
    
    public function getAllByType()
    {
        return SQL("
        SELECT MAX(t1.date) AS data, t2.name
        FROM games AS t1
        INNER JOIN game_types AS t2 ON t1.game_type_id = t2.id
        GROUP BY t2.name
        ORDER BY data DESC, t2.name ASC
        ")->toMap("name", "data");
    }
    
    public function getAllBySoftware()
    {
        return SQL("
        SELECT MAX(t1.date) AS data, t2.name
        FROM games AS t1
        INNER JOIN game_manufacturers AS t2 ON t1.game_manufacturer_id = t2.id
        WHERE t2.is_open = 1
        GROUP BY t2.name
        ORDER BY data DESC, t2.name ASC
        ")->toMap("name", "data");
    }
}
