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
class LoadAllCasinosController extends Lucinda\MVC\STDOUT\Controller {

    const LIMIT = 100;

    public function run() {
        $page = $this->request->parameters("page");
        $offset = ($page * self::LIMIT - self::LIMIT) + 30;
        $casinos = $this->getCasinos([], CasinoSortCriteria::NONE, self::LIMIT, $offset);
        $this->response->attributes("casinos", $casinos['result']);
        $this->response->attributes("type", 'all');
        $this->response->attributes("page_type", "label");
        $this->response->attributes('is_mobile', $this->request->attributes("is_mobile"));
        $this->response->attributes("selected_entity", "all");
        $this->response->attributes("country", $this->request->attributes("country"));
    }

    private function getCasinos($filter, $sortBy, $limit, $offset) {
        $casinoFilter = new CasinoFilter($filter, $this->request->attributes("country"));
        $object = new CasinosList($casinoFilter);
        $results = $object->getResults($sortBy, 0, $limit, $offset);
        $total = $object->getTotal();
        $return = ['total' => $total, 'result' => $results];
        return $return;
    }

}
