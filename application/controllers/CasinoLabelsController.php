<?php
require_once("application/models/dao/CasinoLabels.php");
require_once("application/controllers/CasinosCounterController.php");

/*
* Casino labels list by number of casinos.
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
*/
class CasinoLabelsController extends CasinosCounterController {
    protected function getCounter()
    {
        return new CasinoLabels();
    }
}
