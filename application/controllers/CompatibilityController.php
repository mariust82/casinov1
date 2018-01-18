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
class CompatibilityController extends ParentsListController {
	protected function getResults()
    {
        $object = new OperatingSystems();
        $tmp1 = $object->getAllByNumberOfCasinos();

        $object = new PlayVersions();
        $tmp2 = $object->getAllByNumberOfCasinos();

        return array_merge($tmp1, $tmp2);
    }
}
