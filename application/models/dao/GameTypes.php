<?php
require_once("FieldValidator.php");

class GameTypes
{
    public function getGamesCount() {
        return DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM game_types AS t1
        INNER JOIN games AS t2 ON t1.id = t2.game_type_id
        GROUP BY t1.id
        ORDER BY counter DESC 
        ")->toMap("unit","counter");
    }

    public function getAll() {
        return DB("
        SELECT DISTINCT t1.name
        FROM game_types AS t1
        INNER JOIN games AS t2 ON t1.id = t2.game_type_id
        ORDER BY t1.name ASC 
        ")->toColumn();
    }

    public function getGamesByType() {

        return DB("
        SELECT
        t1.name AS unit, t2.name AS game
        FROM game_types AS t1
        INNER JOIN games AS t2 ON t1.id = t2.game_type_id
        GROUP BY t1.id
        ")->toMap("unit","game");
    }

}