<?php
require_once("application/models/dao/GamesSearch.php");

/*
* Searches for games after show 5 more @ advanced search is clicked
* 
* @requestMethod GET
* @responseFormat JSON
* @source 
* @pathParameter page integer Results page for searched games
* @requestParameter value string Value of searched string
*/
class SearchMoreGamesController extends Lucinda\MVC\STDOUT\Controller {
    const LIMIT = 5;

	public function run() {
        $page = (integer) $this->request->getValidator()->getPathParameter("page");

        $object = new GamesSearch($_GET["value"]);
        $this->response->attributes()->set("results", $object->getResults(self::LIMIT,self::LIMIT *$page));
	}
}
