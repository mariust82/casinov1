<?php
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/CasinoFilter.php");
require_once("application/models/dao/CasinosList.php");
require_once("application/models/dao/Countries.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadMoreCasinosByCountrySliderController
 *
 * @author user
 */
class LoadMoreCasinosByCountrySliderController extends Lucinda\MVC\STDOUT\Controller {

    const LIMIT = 5;


    public function run() {
        $type = $this->request->parameters("type");
        $page = $this->request->parameters("page");
        $id = $this->request->parameters("id");
        $offset = ($page * self::LIMIT - self::LIMIT) + 5;
        $dao = new CasinosList(new CasinoFilter([],$this->request->attributes("country")));
        $object = new Countries();
        $result = $object->getCountryInfo($id);
        $lang_id = !empty($result[0]['lang_id']) ? $result[0]['lang_id'] : '';
        $currency_id = !empty($result[0]['currency_id']) ? $result[0]['currency_id'] : '';
        $c_code = !empty($result[0]['c_code']) ? $result[0]['c_code'] : '';
        $this->response->attributes("country_code", $c_code);
        if ($type == 'best') {
            $this->response->attributes("casinos", $dao->getBestCasinosByCountry($id,$currency_id,$lang_id,self::LIMIT,$offset));
            $this->response->setView('casino-carousel-box');
        } elseif ($type == "ndb") {
            $this->response->attributes("casinos", $dao->getNewestCasinosByCountry($id,self::LIMIT,$offset));
            $this->response->setView('casino-carousel-gridbox');
        }
    }

}
