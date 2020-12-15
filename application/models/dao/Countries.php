<?php
require_once("CasinoCounter.php");

/**
 * Encapsulates operations with countries.
 */
class Countries implements CasinoCounter
{

    /**
     * Gets country ID based on ISO code.
     *
     * @param string $code
     * @return integer
     */
    public function getIDByCode($code)
    {
        return SQL("SELECT id from countries WHERE code=:code", array(':code' => $code))->toValue();
    }

    public function getCountryDetails($name)
    {
        $output = $this->getExceptions();
        if (!in_array($name, $output)) {
            $name = str_replace('-', ' ', $name);
        }
        return SQL("SELECT t3.name as country_name, t3.code as country_code, t1.code,t1.id AS c_id,t2.name,t2.id AS l_id from countries AS t3 INNER JOIN countries__languages AS t4 ON (t3.id = t4.country_id) INNER JOIN currencies AS t1 ON (t1.id = t3.currency_id) INNER JOIN languages AS t2 ON (t2.id = t4.language_id) WHERE LCASE(t3.name)=:code", array(':code' => $name))->toList();
    }

    public function getExceptions()
    {
        $res = SQL("SELECT t1.name from countries AS t1 WHERE t1.name LIKE '%-%'");
        $output = array();
        while ($row = $res->toRow()) {
            $output[] = $row['name'];
        }
        return $output;
    }


    public function getCasinosCount()
    {
        $result = SQL("
        SELECT t1.name AS unit, cnt.nr as counter
        FROM countries AS t1,
             (SELECT t2.country_id, count(t2.casino_id) as nr
              FROM casinos__countries_allowed AS t2
                       INNER JOIN casinos AS t3
                                  ON t2.casino_id = t3.id
              WHERE t3.is_open = 1
              GROUP BY t2.country_id) AS cnt
        WHERE cnt.country_id = t1.id AND t1.code != '"
            . Country::EXCLUDED_COUNTRY_CODE . "'"
        )->toMap("unit", "counter");
        arsort($result);
        return $result;
    }

    public function getAll()
    {
        return SQL("
        SELECT DISTINCT t1.name
        FROM countries AS t1
        INNER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.country_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1
        ORDER BY t1.name ASC 
        ")->toColumn();
    }


    public function getCountryInfo($id)
    {
        return SQL("
            SELECT t1.code, t2.name, t3.name as c_name from countries AS t3 
              INNER JOIN countries__languages AS t4 ON (t3.id = t4.country_id)
              INNER JOIN currencies AS t1 ON (t1.id = t3.currency_id)
              INNER JOIN languages AS t2 ON (t2.id = t4.language_id) 
            WHERE t3.id=:id", array(':id' => $id))->toList();
    }
}
