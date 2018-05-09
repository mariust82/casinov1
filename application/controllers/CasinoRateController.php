<?php
require_once("application/models/dao/Casinos.php");
require_once("vendor/lucinda/nosql-data-access/src/exceptions/OperationFailedException.php");

/*
* Rates a casino.
* 
* @requestMethod POST
* @responseFormat JSON
* @source 
* @pathParameter name string Name of casino
* @requestParameter name Name of casino to be rated.
* @requestParameter value integer Value of rating (1-10)
*/
class CasinoRateController extends Controller {
	public function run() {
        $object = new Casinos();
        $success = $object->rate($_POST["name"], ip2long($this->request->getAttribute("ip")), $_POST["value"]);
        $this->response->setAttribute("success", $success);
        if(!$success) throw new OperationFailedException($success===null?"Casino not found!":"Casino already rated!");
	}
}
