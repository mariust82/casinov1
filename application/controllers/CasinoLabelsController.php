<?php
require_once("application/models/dao/CasinoLabels.php");
require_once("CasinosCounterController.php");
require_once("hlis/widgets/src/ContentManager.php");
/*
* Casino labels list by number of casinos.
*
* @requestMethod GET
* @responseFormat HTML
* @source
*/
class CasinoLabelsController extends CasinosCounterController
{
    protected function getCounter()
    {
        return new CasinoLabels();
    }
}
