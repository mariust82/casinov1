<?php
require_once("entities/Game.php");
require_once("entities/GamePlay.php");

class GameInfo
{
    private $result;

    public function __construct($name, GamePlayer $player) {
        $this->setResult($name, $player);
    }

    private function setResult($name, GamePlayer $player) {
        $object = null;
        $resultSet = DB("
            SELECT t1.id, t1.name, t1.times_played, t2.name AS game_type, t3.name AS software, t1.date_launched, t4.matches AS play_matches, t5.name AS play_type, t6.template_link AS play_pattern
            FROM games AS t1
            INNER JOIN game_types AS t2 ON t1.game_type_id = t2.id
            INNER JOIN game_manufacturers AS t3 ON t1.game_manufacturer_id = t3.id
            LEFT JOIN game_play__matches AS t4 ON t1.id = t4.game_id
            LEFT JOIN game_play__types AS t5 ON t4.type_id = t5.id
            LEFT JOIN game_play__patterns AS t6 ON t4.pattern_id = t6.id
            WHERE
            t1.name = :name
        ",array(":name"=>$name));
        while($row = $resultSet->toRow()) {
            $object = new Game();
            $object->id = $row["id"];
            $object->name = $row["name"];
            $object->times_played = $row["times_played"];
            $object->type = $row["game_type"];
            $object->software = $row["software"];
            $object->release_date = $row["date_launched"];
            $object->play = $player->compile($row["name"], $row["play_pattern"], $row["play_matches"], $row["play_type"]);
        }
        if(!$object) return;

        $resultSet = DB("
            SELECT t2.name
            FROM games__features AS t1
            INNER JOIN game_features AS t2 ON t1.feature_id = t2.id
            WHERE
            t1.game_id = :id
        ",array(":id"=>$object->id));
        while($row = $resultSet->toRow()) {
            switch($row["name"]) {
                case "3D Animation":
                    $object->is_3d = true;
                    break;
                case "Mobile":
                    $object->is_mobile = true;
                    break;
                case "HTML5":
                case "Flash":
                    $object->technologies[] = $row["name"];
                    break;
            }
        }

        $this->result = $object;
    }

    public function getResult() {
        return $this->result;
    }
}