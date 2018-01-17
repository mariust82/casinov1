<?php
/*
* Games list by game type.
* 
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/cde70121-39ba-4e3e-bb0f-d39a534d5f5c/Game-list?fullscreen
* @pathParameter type string Name of game type
*/
class GamesByTypeController extends GamesListController {
	public function run() {
		parent::run();
		
$this->response->setAttribute("game_types", array (
  0 => 'random#8',
));
$this->response->setAttribute("softwares", array (
  0 => 'random#8',
));
	}
}
