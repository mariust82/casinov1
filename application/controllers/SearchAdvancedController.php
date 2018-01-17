<?php
/*
* Page to display after show all results is clicked @ search page
* 
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/015eebd7-3b58-43a8-a8db-24dd6f810135/Search?fullscreen
* @requestParameter value string Value of searched string
*/
class SearchAdvancedController extends Controller {
	public function run() {
		
$this->response->setAttribute("value", 'random#10');
$this->response->setAttribute("casinos", array (
  0 => 'random#1',
));
$this->response->setAttribute("total_casinos", 6);
$this->response->setAttribute("games", array (
  0 => 'random#10',
));
$this->response->setAttribute("total_games", 2);
	}
}
