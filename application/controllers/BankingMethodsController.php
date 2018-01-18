<?php
require_once("application/models/dao/BankingMethods.php");

/*
* Banking methods list by number of casinos.
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
*/
class BankingMethodsController extends ParentsListController {
    protected function getResults()
    {
        $object = new BankingMethods();
        return $object->getAllByNumberOfCasinos();
    }
}
