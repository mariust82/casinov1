<?php
require_once("application/models/dao/Countries.php");

/*
* Countries list by number of casinos
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
*/
class CountriesController extends ParentsListController {
    protected function getResults()
    {
        $object = new Countries();
        return $object->getAllByNumberOfCasinos();
    }
}
