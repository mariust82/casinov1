<?php
require_once("application/models/dao/Countries.php");
require_once("CasinosCounterController.php");

/*
* Countries list by number of casinos
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
*/
class CountriesController extends CasinosCounterController {

    protected function getResults(CasinoCounter $object) {

        $counts = $object->getCasinosCount();
        // start hardcoding: Make user country be first in list
        if(array_key_exists($this->request->getAttribute("country")->name, $counts)){
            $userCountry = array($this->request->getAttribute("country")->name => $counts[$this->request->getAttribute("country")->name]);
            unset($counts[$this->request->getAttribute("country")->name]);
            $counts = $userCountry + $counts;
        }
        return $counts;
    }

    protected function getCounter(){
        return new Countries();
    }

}
