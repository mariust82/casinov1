<?php
require_once("application/models/dao/BonusTypes.php");
require_once("BaseController.php");
/*
* Bonus types list by number of casinos.
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
*/
class BonusesController extends BaseController {
    protected function getResults(){
        $object =  new BonusTypes();
        return $object->getCasinosCount();
    }
}
