<?php
require_once 'application/models/dao/sitemap/Sitemap.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompatibilitySitemap
 *
 * @author matan
 */
class CompatibilitySitemap extends Sitemap{
   
    private function setLastMod() {
        return explode(' ',SQL("SELECT MAX(t1.date) FROM casinos AS t1 LEFT OUTER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id AND t2.country_id = {$this->country} INNER JOIN casinos__play_versions AS t9 ON t1.id = t9.casino_id AND t9.play_version_id = (SELECT id FROM play_versions WHERE name = 'mobile') WHERE t1.is_open = 1")->toValue())[0];
    }
    
    public function getLastMod() {
        return $this->setLastMod();
    }
}
