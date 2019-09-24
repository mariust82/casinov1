<?php
require_once("application/models/dao/BonusTypes.php");
require_once("CasinosCounterController.php");
/*
* Bonus types list by number of casinos.
*
* @requestMethod GET
* @responseFormat HTML
* @source
*/
class BonusesController extends CasinosCounterController
{
    protected function getCounter()
    {
        return new BonusTypes();
    }
}
