<?php
require_once("FieldValidator.php");

class GameTypes implements FieldValidator
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

    public function getGamesByType() {
        return DB("
        SELECT
        t1.name AS unit, t2.name AS game
        FROM game_types AS t1
        INNER JOIN games AS t2 ON t1.id = t2.game_type_id
        GROUP BY t1.id
        ")->toMap("unit","game");
    }

    public function validate($name) {
        return DB("SELECT name FROM game_types WHERE name=:name",array(":name"=>$name))->toValue();
    }
}