<?php
require_once("application/models/dao/CasinoLabels.php");

/*
* Casino labels list by number of casinos.
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
*/
class CasinoLabelsController extends ParentsListController {
    protected function getResults()
    {
        $object = new CasinoLabels();
        return $object->getAllByNumberOfCasinos();
    }
}
