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
class CasinoVisitController extends Lucinda\MVC\STDOUT\Controller {
	public function run() {
     //   $casino_name = $this->request->getValidator()->getPathParameter('name');
       $casino_id =  $this->request->attributes()->get('validation_results')->get('name');
        new SiteCasinoClick($casino_id);
	}
}
