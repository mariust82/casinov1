<?php
class GamesSearch
{
    private $value;

    public function __construct($value) {
        $this->value = $value;
    }

    public function getResults($limit, $offset) {
        return SQL("
            SELECT name
            FROM games
            WHERE name LIKE :name
            ORDER BY id DESC, name ASC
            LIMIT ".$limit." OFFSET ".$offset,
            array(":name"=>"%".$this->value."%"))->toColumn();
    }

    public function getTotal() {
        // build query
        return (integer) SQL("
            SELECT COUNT(id) AS nr FROM games WHERE name LIKE :name",
            array(":name"=>"%".$this->value."%"))->toValue();
    }
}