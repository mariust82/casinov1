<?php
require_once("application/models/GamePlayCounterUpdate.php");
require_once("application/models/UserOperationFailedException.php");

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
            $this->request->attributes('validation_results')->get('name')
            );
	}
}
