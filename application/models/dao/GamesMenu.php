<?php
require_once("entities/MenuItem.php");
require_once("GameTypes.php");

class GamesMenu
{
    private $pages = array();

    public function __construct($selectedEntry) {
        $this->setEntries($selectedEntry);
    }

    private function setEntries($selectedEntry) {
        $types = DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM game_types AS t1
        INNER JOIN games AS t2 ON t1.id = t2.game_type_id
        GROUP BY t1.id
        ORDER BY counter DESC 
        ")->toColumn();
        foreach($types as $name) {
            $object = new MenuItem();
            $object->title = $name;
            $object->url = "/games/".$this->generatePathParameter($name);
            $object->is_active = ($name==$selectedEntry?true:false);
            $this->pages[] = $object;
        }
    }

    private function generatePathParameter($name) {
        return strtolower(str_replace(" ", "-", $name));
    }

    public function getEntries() {
        return $this->pages;
    }
}