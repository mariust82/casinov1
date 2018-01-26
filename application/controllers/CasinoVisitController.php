<?php
require_once("application/models/SiteCasinoClick.php");

/*
* Records click and redirects to casino or warning.
* 
* @requestMethod GET
* @responseFormat 
* @source 
* @pathParameter name string Name of casino
*/
class CasinoVisitController extends Controller {
	public function run() {
        $casino_name = $this->request->getValidator()->getPathParameter('name');
        if(!$casino_name) throw new PathNotFoundException();

        new SiteCasinoClick(str_replace("-"," ", $casino_name));
	}
}
