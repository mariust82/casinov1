<?php
/*
* Searches database for casinos and games
* 
* @requestMethod GET
* @responseFormat JSON
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/015eebd7-3b58-43a8-a8db-24dd6f810135/Search?fullscreen
* @requestParameter value string Value of searched string
*/
class SearchController extends Controller {
	public function run() {
		
$this->response->setAttribute("casinos", array (
  0 => 'random#1',
));
$this->response->setAttribute("games", array (
  0 => 'random#5',
));
	}
}
