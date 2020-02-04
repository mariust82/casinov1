<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PagesSitemap
 *
 * @author matan
 */
class PagesSitemap {
    private $country;
    
    public function __construct($country) {
        $this->country = $country;
    }
    
    private function setPagesRows() {
        $casinos = explode(' ',SQL("SELECT MAX(t3.date) FROM casino_labels AS t1 INNER JOIN casinos__labels AS t2 ON t1.id = t2.label_id INNER JOIN casinos AS t3 ON t2.casino_id = t3.id WHERE t3.is_open = 1 AND t1.id != 8 AND t1.id != 3 AND t1.id != 1")->toValue())[0];
        $softwares = explode(' ', SQL("SELECT MAX(t3.date) FROM game_manufacturers AS t1 INNER JOIN casinos__game_manufacturers AS t2 ON t1.id = t2.game_manufacturer_id INNER JOIN casinos AS t3 ON t2.casino_id = t3.id WHERE t3.is_open = 1")->toValue())[0];
        $countries = explode(' ', SQL("SELECT MAX(t3.date) FROM countries AS t1 INNER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.country_id INNER JOIN casinos AS t3 ON t2.casino_id = t3.id WHERE t3.is_open = 1")->toValue())[0];
        $banking = explode(' ', SQL("SELECT val FROM ( SELECT MAX(t2.date) AS val FROM casinos__withdraw_methods AS t1 INNER JOIN banking_methods AS t3 ON (t1.banking_method_id = t3.id) INNER JOIN casinos AS t2 ON t2.id = t1.casino_id WHERE t2.is_open=1 UNION SELECT MAX(t2.date) AS val FROM casinos__deposit_methods AS t1 INNER JOIN banking_methods AS t3 ON (t1.banking_method_id = t3.id) INNER JOIN casinos AS t2 ON t2.id = t1.casino_id WHERE t2.is_open=1 ) AS alias")->toValue())[0];
        $games = explode(' ', SQL("SELECT MAX(t1.date) FROM games AS t1 INNER JOIN game_types AS t3 ON t1.game_type_id = t3.id INNER JOIN game_play__matches AS t6 ON t1.id = t6.game_id INNER JOIN game_play__patterns AS t7 ON t7.id = t6.pattern_id AND t7.isMobile IN (0,1,2) INNER JOIN games__features AS t8 ON t1.id = t8.game_id AND t8.feature_id IN (7,8) WHERE t1.is_open = 1")->toValue())[0];
        $pages = ["Casinos"=>$casinos,"Softwares"=>$softwares,"Countries"=>$countries,"Banking"=>$banking,"Games"=>$games];
        array_multisort($pages, SORT_DESC);
        return $pages;
    }
    
    public function getPagesRows() {
        return $this->setPagesRows();
    }
    
    
}
