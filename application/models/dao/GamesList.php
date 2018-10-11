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

        if ($page > 1) {
            $offset = ($page-1) *$limit ;
        }else{
            $offset = 0;
        }

        // build query
        $query = $this->getQuery(array("t1.id", "t1.name", "t1.times_played", "t2.name AS software"));
        switch($sortBy) {
            case GameSortCriteria::NEWEST:
                $query .= "ORDER BY t1.id DESC"."\n";
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

        $resultSet = DB($query);

        while($row = $resultSet->toRow()) {
            $object = new Game();
            $object->id = $row["id"];
            $object->name = $row["name"];
            $object->times_played = $row["times_played"];
            $object->software = $row["software"];
            $output[$row["id"]] = $object;
        }
        return $output;
    }

    public function getTotal() {
        // build query
        $query = $this->getQuery(array("COUNT(t1.id) AS nr"));
        return (integer) DB($query)->toValue();
    }

    private function getQuery($columns) {
        $sub_join = "";
        $sub_where = "";
        
        if($this->filter->isMobile()) {
            $sub_join = " INNER JOIN games__features AS t4 ON t1.id = t4.game_id ";
            $sub_where = "t4.feature_id = 7 AND ";
        }
        
        $query = "
        SELECT
            ".implode(",", $columns)."
        FROM games AS t1
        INNER JOIN game_manufacturers AS t2 ON t1.game_manufacturer_id = t2.id
        INNER JOIN game_types AS t3 ON t1.game_type_id = t3.id
        ".$sub_join."
        WHERE 1 AND ".$sub_where."";
        if($this->filter->getSoftwares()) {
            $query.="t2.name IN ('".implode("','", $this->filter->getSoftwares())."') AND ";
        }
        if($this->filter->getGameType()) {
            $query.="t3.name='".$this->filter->getGameType()."' AND ";
        }
        return substr($query,0,-4);
    }
}