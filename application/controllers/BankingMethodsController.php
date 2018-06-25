<?php
require_once("application/models/dao/BankingMethods.php");
require_once("application/controllers/BaseController.php");

/*
* Banking methods list by number of casinos.
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
*/
class BankingMethodsController extends BaseController {
    protected function getResults()
    {
        $object =  new BankingMethods();
        return $object->getCasinosCount();
    }
}
