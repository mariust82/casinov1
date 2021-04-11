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
    
    public function getFeaturedGames($isMobile)
    {
        return SQL("
        SELECT 
        t1.times_played, t1.id, t2.name AS manufacturer_name, t1.name
        FROM games AS t1
        INNER JOIN game_manufacturers AS t2 ON t1.game_manufacturer_id = t2.id
        INNER JOIN game_types AS t3 ON t1.game_type_id = t3.id
        WHERE t1.id != 13450 AND t1.is_open = 1 AND t2.is_open = 1 AND t3.name = 'Video Slots' AND t1.id IN (
            SELECT t6.game_id
            FROM game_play__matches AS t6
            INNER JOIN game_play__patterns AS t7 ON t7.id = t6.pattern_id AND t7.isMobile IN (1,2)
            INNER JOIN games__features AS t8 ON t6.game_id = t8.game_id AND t8.feature_id = 7
        )
        ORDER BY t1.date_launched DESC, t1.id DESC
        LIMIT 8
        ")->toList();
    }

    public function getAllSoftwares() {

        return SQL("SELECT MAX(t1.date) AS data, t1.name
        FROM game_manufacturers AS t1
        INNER JOIN casinos__game_manufacturers AS t2 ON t1.id = t2.game_manufacturer_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        LEFT JOIN games as g on g.game_manufacturer_id = t1.id
        WHERE t3.is_open = 1
        GROUP BY t1.id
        ORDER BY data DESC, t1.name ASC")->toMap("name", "data");
    }
}
