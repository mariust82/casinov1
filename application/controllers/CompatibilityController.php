<?php
require_once("application/models/dao/OperatingSystems.php");
require_once("application/models/dao/PlayVersions.php");

/*
* Operating system and play version list by number of casinos.
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
*/
class CompatibilityController extends Controller {
	public function run()
    {
        $object = new OperatingSystems();
        $tmp1 = $object->getCasinosCount();

        $object = new PlayVersions();
        $tmp2 = $object->getCasinosCount();

        $this->response->setAttribute("results", array_merge($tmp1, $tmp2));
    }
}
