<?php
/*
* Searches for games after show 5 more @ advanced search is clicked
* 
* @requestMethod GET
* @responseFormat JSON
* @source 
* @pathParameter page integer Results page for searched games
* @requestParameter value string Value of searched string
*/
class SearchMoreGamesController extends Controller {
	public function run() {
		
$this->response->setAttribute("casinos", array (
  0 => 'random#10',
));
	}
}
