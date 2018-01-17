<?php
/*
* Searches for casinos after show 5 more @ advanced search is clicked
* 
* @requestMethod GET
* @responseFormat JSON
* @source 
* @pathParameter page integer Results page for searched casinos
* @requestParameter value string Value of searched string
*/
class SearchMoreCasinosController extends Controller {
	public function run() {
		
$this->response->setAttribute("casinos", array (
  0 => 'random#4',
));
	}
}
