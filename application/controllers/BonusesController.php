<?php
require_once("application/models/dao/BonusTypes.php");

/*
* Bonus types list by number of casinos.
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
*/
class BonusesController extends ParentsListController {
    protected function getResults()
    {
        $object = new BonusTypes();
        return $object->getAllByNumberOfCasinos();
    }
}
