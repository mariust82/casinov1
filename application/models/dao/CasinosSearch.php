<?php
class CasinosSearch
{
    private $value;

    public function __construct($value) {
        $this->value = $value;
    }

    public function getResults($limit, $offset) {
        return DB("
            SELECT name
            FROM casinos
            WHERE name LIKE :name AND is_open=1
            ORDER BY date_established DESC, name ASC
            LIMIT ".$limit." OFFSET ".$offset,
            array(":name"=>"%".$this->value."%"))->toColumn();
    }

    public function getTotal() {
        // build query
        return (integer) DB("
            SELECT COUNT(id) AS nr 
            FROM casinos 
            WHERE name LIKE :name AND is_open=1",
            array(":name"=>"%".$this->value."%"))->toValue();
    }
}