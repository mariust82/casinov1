<?php
require_once("application/models/CasinoSortCriteria.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadMorCasinosBySoftwareController
 *
 * @author user
 */
class LoadMorCasinosBySoftwareController extends Lucinda\MVC\STDOUT\Controller {

    public function run() {
        $this->response->attributes("casinos", $this->getCasinos([], CasinoSortCriteria::NEWEST, 5,'New')['result']);
    }

    private function getCasinos($filter, $sortBy, $limit, $label = '') {
        $casinoFilter = new CasinoFilter($filter, $this->request->attributes("country"));
        if (!empty($label)) {
            $casinoFilter->setCasinoLabel($label);
            if ($label == 'Best') {
                $casinoFilter->setPromoted(TRUE);
            }
        }
        $casinoFilter->setSoftware($this->getSelectedEntity());
        $object = new CasinosList($casinoFilter);
        $results = $object->getResults($sortBy, 0, $limit);
        $total = $object->getTotal();
        $return = ['total' => $total, 'result' => $results];
        return $return;
    }

}
