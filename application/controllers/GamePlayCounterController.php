<?php
require_once("application/models/dao/Games.php");
require_once("vendor/lucinda/nosql-data-access/src/exceptions/OperationFailedException.php");

/*
* Increments play count of a game
* 
* @requestMethod POST
* @responseFormat JSON
* @source 
* @requestParameter name Name of game to be played.
*/
class GamePlayCounterController extends Controller {
	public function run() {
		$object = new Games();
		$success = $object->incrementTimesPlayed($_POST["name"]);
		if(!$success) throw new OperationFailedException("Game not found!");
	}
}
