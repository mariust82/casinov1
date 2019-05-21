<?php
require_once("application/models/dao/Casinos.php");
require_once("application/models/dao/BestCasinoLabel.php");
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
class CasinoRateController extends Lucinda\MVC\STDOUT\Controller {
	public function run() {
        $casinoID = $this->request->attributes()->get('validation_results')->get('name');
        $object = new Casinos();
       if($object->isCountryAccepted($casinoID, $this->request->attributes()->get("country")->id))  {
            $success = $object->rate(
                $this->request->attributes()->get('validation_results')->get('name'),
                $this->request->attributes()->get("ip"),
                $this->request->attributes()->get('validation_results')->get('value')
            );
           $this->response->attributes()->set("success", $success);
           if($success) {
               $object = new BestCasinoLabel();
               $object->checkRatedCasino($casinoID);
           }
           if(!$success) throw new OperationFailedException("Casino already rated!");
        }else { // if country is not accepted by casino, here, the exception is throed.
            throw new OperationFailedException("Your country is not supported!");
        }
	}
}
