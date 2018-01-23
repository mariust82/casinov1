<?php
require_once("application/models/dao/BankingMethods.php");
require_once("application/controllers/CasinosCounterController.php");

/*
* Banking methods list by number of casinos.
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
*/
class BankingMethodsController extends CasinosCounterController {
    protected function getCounter()
    {
        return new BankingMethods();
    }
}
