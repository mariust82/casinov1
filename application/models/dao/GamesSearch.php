<?php
class GamesSearch
{
    private $value;

    public function __construct($value) {
        $this->value = $value;
    }

    public function getResults($limit, $offset) {
        return DB("
            SELECT name
            FROM games
            WHERE name LIKE :name
            ORDER BY name ASC
            LIMIT ".$limit." OFFSET ".$offset,
            array(":name"=>"%".$this->value."%"))->toColumn();
    }

    public function getTotal() {
        // build query
        return (integer) DB("
            SELECT COUNT(id) AS nr FROM games WHERE name LIKE :name",
            array(":name"=>"%".$this->value."%"))->toValue();
    }
}