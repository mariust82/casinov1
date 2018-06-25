<?php
require_once("application/models/dao/CasinoLabels.php");
require_once("application/controllers/BaseController.php");

/*
* Casino labels list by number of casinos.
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
*/
class CasinoLabelsController extends BaseController {
    protected function getResults()
    {
        $object =  new CasinoLabels();
        return $object->getCasinosCount();
    }
}
