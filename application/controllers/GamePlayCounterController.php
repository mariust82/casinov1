<?php
require_once("application/models/GamePlayCounterUpdate.php");
require_once("vendor/lucinda/nosql-data-access/src/exceptions/OperationFailedException.php");

/*
* Increments play count of a game
* 
* @requestMethod POST
* @responseFormat JSON
* @source 
* @requestParameter name Name of game to be played.
*/
class GamePlayCounterController extends Lucinda\MVC\STDOUT\Controller {
	public function run() {
	    new GamePlayCounterUpdate(
	        $this->request->getSession(),
            $this->request->attributes()->get('validation_results')->get('name')
            );
	}
}
