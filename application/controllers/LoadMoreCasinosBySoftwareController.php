<?php
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/CasinoFilter.php");
require_once("application/models/dao/CasinosList.php");
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
class LoadMoreCasinosBySoftwareController extends Lucinda\MVC\STDOUT\Controller {

    const LIMIT = 10;


    public function run() {
        $type = $this->request->parameters("type");
        $page = $this->request->parameters("page");
        $offset = ($page * self::LIMIT - self::LIMIT) + 5;
        if ($type == 'new') {
            $this->response->attributes("casinos", $this->getCasinos([], CasinoSortCriteria::NEWEST, self::LIMIT,$offset,'New')['result']);
        } elseif ($type == 'best') {
            $this->response->attributes("casinos", $this->getCasinos([], CasinoSortCriteria::TOP_RATED, self::LIMIT,$offset,'Best')['result']);
        } else {
            $this->response->attributes("casinos", $this->getCasinos(array("country_accepted"=>1), CasinoSortCriteria::POPULARITY, self::LIMIT,$offset)['result']);
        }
        $this->response->attributes("page_type", "software");
        $this->response->attributes('is_mobile', $this->request->attributes("is_mobile"));
        $this->response->attributes("selected_entity", $this->request->parameters("software"));
        $this->response->attributes("country", $this->request->attributes("country"));
        
    }

    private function getCasinos($filter, $sortBy, $limit,$offset, $label = '') {
        $casinoFilter = new CasinoFilter($filter, $this->request->attributes("country"));
        if (!empty($label)) {
            $casinoFilter->setCasinoLabel($label);
            if ($label == 'Best') {
                $casinoFilter->setPromoted(TRUE);
            }
        }
        $casinoFilter->setSoftware($this->request->parameters("software"));
        $object = new CasinosList($casinoFilter);
        $results = $object->getResults($sortBy, 0, $limit,$offset);
        $total = $object->getTotal();
        $return = ['total' => $total, 'result' => $results];
        return $return;
    }

}
