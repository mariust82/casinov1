<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CasinosSitemap
 *
 * @author matan
 */
class CasinosSitemap {

    private $country;
    
    public function __construct($country) {
        $this->country = $country;
    }
    
    public function getCasinosByLabelLastMod() {
        return $this->setCasinosByLabelLastMod();
    }

    private function setCasinosByLabelLastMod() {
        $output = [];
        $labels = ["Best", "New", "Popular", "Blacklisted Casinos", "Low Wagering", "No Account Casinos"];
        foreach ($labels as $label) {
            $order = 't1.priority DESC, t1.id DESC';
            
            if ($label == 'New') {
                $now = date("Y-m-d");
                $date = strtotime($now . ' -1 year');
                $last = date('Y-m-d', $date);
                $output[$label] = SQL("SELECT MAX(t1.date) FROM casinos AS t1 LEFT OUTER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id AND t2.country_id = {$this->country} WHERE t1.is_open = 1 AND t1.date_established > '{$last}' ORDER BY t1.date_established DESC, t1.priority DESC, t1.id DESC")->toValue();
            } else {
                switch ($label) {
                    case 'Best':
                        $order = ' ORDER BY (t1.rating_total/t1.rating_votes)  DESC, t1.priority DESC, t1.id DESC ';
                        break;
                    case 'Low Wagering':
                        $order = ' ORDER BY t5.id ASC ';
                        break;
                    case 'No Account Casinos':
                        $order = 'ORDER BY t1.priority DESC, t1.date_established DESC, t1.id DESC';
                            break;
                    default:
                        $order = ' ORDER BY t1.priority DESC, t1.id DESC ';
                        break;
                }
                $output[$label] = SQL("SELECT MAX(t1.date) FROM casinos AS t1 LEFT OUTER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id AND t2.country_id = {$this->country} INNER JOIN casinos__labels AS t5 ON t1.id = t5.casino_id AND t5.label_id = (SELECT id FROM casino_labels WHERE name = '{$label}') WHERE t1.is_open = 1 {$order}")->toValue();
            }
        }
        array_multisort($output, SORT_DESC);
        return $output;
    }

}
