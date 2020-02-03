<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BankingSitemap
 *
 * @author matan
 */
class BankingSitemap {
    
    private $country;
    
    public function __construct($country) {
        $this->country = $country;
    }
    
    private function setBankingRows() {
        $output = [];
        $methods = $this->getAll();
        foreach ($methods as $key => $value) {
            $output[$value] = SQL("SELECT MAX(t1.date) FROM casinos AS t1 LEFT OUTER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id AND t2.country_id = {$this->country} LEFT OUTER JOIN casinos__deposit_methods AS t3 ON t1.id = t3.casino_id AND t3.banking_method_id = {$key} LEFT OUTER JOIN casinos__withdraw_methods AS t14 ON t1.id = t14.casino_id AND t14.banking_method_id = {$key} WHERE t1.is_open = 1 AND (t3.id IS NOT NULL OR t14.id IS NOT NULL)")->toValue();
        }
        return $output;
    }
    
    public function getBankingRows() {
        return $this->setBankingRows();
    }

    private function getAll()
    {
        return SQL("
        SELECT DISTINCT t1.name,t1.id
        FROM banking_methods AS t1
        INNER JOIN casinos__deposit_methods AS t2 ON t1.id = t2.banking_method_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1
        ORDER BY t1.name ASC
        ")->toMap("id","name");
    }
}
