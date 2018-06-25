<?php
require_once("application/models/dao/GameTypes.php");
require_once("BaseController.php");
/*
* Game types list by number of games.
* 
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/37fe259e-efa9-47c2-a5e3-24b79e07b3c5/Games?fullscreen
*/
class GameTypesController extends BaseController {
	protected function getResults() {
		$object = new GameTypes();
		return $object->getGamesCount();
	}
}
