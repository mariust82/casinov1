<?php
require_once("entities/Game.php");

class GamesList
{
    private $filter;
    const LIMIT = 24;

    public function __construct(GameFilter $filter)
    {
        $this->filter = $filter;

    }

    public function getResults($sortBy, $page, $limit = self::LIMIT, $offset='') {


        // build query
        $query = $this->getQuery(array("t1.id", "t1.name", "t1.times_played", "t2.name AS software"));
        switch($sortBy) {
            case GameSortCriteria::NEWEST:
                $query .= "ORDER BY  t1.date_launched DESC ,t1.id DESC"."\n";
                break;
            case GameSortCriteria::MOST_PLAYED:
                $query .= "ORDER BY t1.times_played DESC, t1.priority ASC, t1.id DESC"."\n";
                break;
            default:
                $query .= "ORDER BY t1.priority ASC, t1.id DESC"."\n";
                break;
        }

        $query .= !empty($limit) ?  " LIMIT ". $limit : '';
        $query .= !empty($offset) ? " OFFSET ". $offset : '';
        $output = array();
        $resultSet = SQL($query);

        while($row = $resultSet->toRow()) {
            $object = new Game();
            $object->id = $row["id"];
            $object->name = $row["name"];
            $object->times_played = $row["times_played"];
            $object->software = $row["software"];
            $object->logo_big = "public/sync/game_ss/300x220/".str_replace(" ", "_", $row["name"])."_ss.jpg";
            $object->logo_small = "public/sync/game_ss/136x100/".str_replace(" ", "_", $row["name"])."_ss.jpg";
            $output[$row["id"]] = $object;
        }
        return $output;
    }

    public function getTotal() {
        // build query
        $query = $this->getQuery(["COUNT(t1.id) AS nr"]);
        $result =SQL($query)->toValue();
        return $result;
    }

    private function getQuery($columns) {
        $sub_where = "";
        $sub_join = " INNER JOIN games__features AS t4 ON t1.id = t4.game_id INNER JOIN game_play__matches AS t6 ON t1.id = t6.game_id INNER JOIN game_play__patterns AS t5 ON t5.id = t6.pattern_id AND t5.type_id != 4";
        if($this->filter->isMobile()) {
            $sub_where = "t4.feature_id = 7 AND ";
        } else {
            $sub_where = "t4.feature_id = 8 AND ";
        }
        
        $query = "
        SELECT
            ".implode(",", $columns)."
        FROM games AS t1
        INNER JOIN game_manufacturers AS t2 ON t1.game_manufacturer_id = t2.id
        INNER JOIN game_types AS t3 ON t1.game_type_id = t3.id
        ".$sub_join."
        WHERE 1 AND t1.is_open = 1 AND t2.is_open = 1 AND ".$sub_where."";
        if($this->filter->getSoftwares()) {
            $query.="t2.name IN ('".implode("','", $this->filter->getSoftwares())."') AND ";
        }
        if($this->filter->getGameType()) {
            $query.="t3.name='".$this->filter->getGameType()."' AND ";
        }
        
        if ($this->filter->getCurrentgame()) {
            $query.="t1.name != {$this->filter->getCurrentgame()}";
        }
        return substr($query,0,-4);
    }
}