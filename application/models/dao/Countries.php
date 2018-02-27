<?php
/**
 * Encapsulates operations with countries.
 */
class Countries
{
    /**
     * Gets country ID based on ISO code.
     *
     * @param string $code
     * @return integer
     */
    public function getIDByCode($code)
    {
        return DB("SELECT id from countries WHERE code=:code", array(':code' => $code))->toValue();
    }

    public function validate($name) {
        return DB("SELECT name FROM countries WHERE name=:name",array(":name"=>$name))->toValue();
    }

    public function getCasinosCount()
    {
        return DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM countries AS t1
        INNER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.country_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1
        GROUP BY t1.id
        ORDER BY counter DESC 
        ")->toMap("unit","counter");
    }

    public function getAll()
    {
        return DB("
        SELECT DISTINCT t1.name
        FROM countries AS t1
        INNER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.country_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1
        ORDER BY t1.name ASC 
        ")->toColumn();
    }
}