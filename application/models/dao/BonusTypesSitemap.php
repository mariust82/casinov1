<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BonusTypesSitemap
 *
 * @author matan
 */
class BonusTypesSitemap {
    private $country;
    
    public function __construct($country) {
        $this->country = $country;
    }
    
    private function setLastMod() {
        return explode(' ',SQL("SELECT MAX(t1.date) FROM casinos AS t1 LEFT OUTER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id AND t2.country_id = {$this->country} INNER JOIN casinos__bonuses AS t4 ON t1.id = t4.casino_id AND t4.bonus_type_id IN (3,4,5,6,11) WHERE t1.is_open = 1")->toValue())[0];
    }
    
    public function getLastMod() {
        return $this->setLastMod();
    }
}