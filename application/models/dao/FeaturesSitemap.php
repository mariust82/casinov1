<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FeaturesSitemap
 *
 * @author matan
 */
class FeaturesSitemap {
    private $country;
    
    public function __construct($country) {
        $this->country = $country;
    }
    
    private function setLastMod() {
        return explode(' ',SQL("SELECT MAX(t1.date) FROM casinos AS t1 LEFT OUTER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id AND t2.country_id = {$this->country} INNER JOIN casinos__certifications AS t6 ON t1.id = t6.casino_id AND t6.certification_id = (SELECT id FROM certifications WHERE name = 'ecogra') WHERE t1.is_open = 1")->toValue())[0];
    }
    
    public function getLastMod() {
        return $this->setLastMod();
    }
}
