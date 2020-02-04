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
class GameManufacturersSitemap {
    
    private $country;
    
    public function __construct($country) {
        $this->country = $country;
    }
    
    private function setGameManufacturersRows() {
        $output = [];
        $softwares = $this->getAll();
        foreach ($softwares as $value) {
            $output[$value] = SQL("SELECT MAX(t1.date) FROM casinos AS t1 LEFT OUTER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id AND t2.country_id = {$this->country} INNER JOIN casinos__game_manufacturers AS t10 ON t1.id = t10.casino_id AND t10.game_manufacturer_id = (SELECT id FROM game_manufacturers WHERE name = '{$value}') WHERE t1.is_open = 1 ")->toValue();
        }
        array_multisort($output, SORT_DESC);
        return $output;
    }
    
    public function getGameManufacturersRows() {
        return $this->setGameManufacturersRows();
    }
    
    private function getAll()
    {
        return SQL("
        SELECT DISTINCT t1.name
        FROM game_manufacturers AS t1
        INNER JOIN casinos__game_manufacturers AS t2 ON t1.id = t2.game_manufacturer_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1
        ORDER BY t1.name ASC 
        ")->toColumn();
    }
    
}
