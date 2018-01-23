<?php
require_once("application/models/dao/Countries.php");
require_once("application/controllers/CasinosCounterController.php");

/*
* Countries list by number of casinos
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
*/
class CountriesController extends CasinosCounterController {
    protected function getCounter()
    {
        return new Countries();
    }
}
