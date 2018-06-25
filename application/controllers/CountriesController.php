<?php
require_once("application/models/dao/Countries.php");
require_once("BaseController.php");

/*
* Countries list by number of casinos
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
*/
class CountriesController extends BaseController {

    public function getResults() {

        $object = new Countries();
        $results = $object->getCasinosCount();
        //Make user country be first in list
        if(array_key_exists($this->request->getAttribute("country")->name, $results)){
            $userCountry = array($this->request->getAttribute("country")->name => $results[$this->request->getAttribute("country")->name]);
            unset($results[$this->request->getAttribute("country")->name]);
            $results = $userCountry + $results;
        }
        return $results;

    }

}
