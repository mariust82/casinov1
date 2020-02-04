<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GameManufacturersSitemap
 *
 * @author matan
 */
class CountriesSitemap {
    
    private $country;
    
    public function __construct($country) {
        $this->country = $country;
    }
    
    private function setCountriesRows() {
        $output = [];
        $countries = $this->getAll();
        foreach ($countries as $value) {
            $query_value = str_replace("'", "\'", $value);
            $date = SQL("SELECT MAX(t1.date) FROM casinos AS t1 LEFT OUTER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id AND t2.country_id = {$this->country} INNER JOIN casinos__countries_allowed AS t7 ON t1.id = t7.casino_id AND t7.country_id = (SELECT id FROM countries WHERE name = '{$query_value}') AND t1.is_open = 1")->toValue();
            $output[$value] = explode(' ', $date)[0];
        }
        array_multisort($output, SORT_DESC);
        return $output;
    }
    
    public function getCountriesRows() {
        return $this->setCountriesRows();
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
    
}
