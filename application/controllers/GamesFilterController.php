<?php
/*
* Filters games according to selections
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
* @requestParameter type string Value of current game type
* @requestParameter filter_by string Name of game manufacturer (software)
* @requestParameter sort string Value can be "default", "top rated" or "newest"
*/
class GamesFilterController extends GamesListController {
	public function run() {
		parent::run();
		// response
	}
}
