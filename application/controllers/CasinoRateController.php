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
        $casinoID = $this->request->getAttribute('validation_results')->get('name');
        $object = new Casinos();
       if($object->isCountryAccepted($casinoID, $this->request->getAttribute("country")->id))  {
            $success = $object->rate(
                $this->request->getAttribute('validation_results')->get('name'),
                $this->request->getAttribute("ip"),
                $this->request->getAttribute('validation_results')->get('value')
            );
           $this->response->setAttribute("success", $success);
            if(!$success) throw new OperationFailedException("Casino already rated!");
        }else { // if country is not accepted by casino, here, the exception is throed.
            throw new OperationFailedException("Your country is not supported!");
        }
	}
}
