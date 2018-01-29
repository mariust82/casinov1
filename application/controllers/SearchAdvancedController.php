<?php
require_once("application/models/dao/CasinosSearch.php");
require_once("application/models/dao/GamesSearch.php");

/*
* Page to display after show all results is clicked @ search page
* 
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/015eebd7-3b58-43a8-a8db-24dd6f810135/Search?fullscreen
* @requestParameter value string Value of searched string
*/
class SearchAdvancedController extends Controller {
    const LIMIT = 5;

	public function run() {
	    $this->response->setAttribute("value", $_GET["value"]);

        $casinos = new CasinosSearch($_GET["value"]);
        $this->response->setAttribute("casinos", $casinos->getResults(self::LIMIT,0));
        $this->response->setAttribute("total_casinos", $casinos->getTotal());

        $games = new GamesSearch($_GET["value"]);
        $this->response->setAttribute("games", $games->getResults(self::LIMIT,0));
        $this->response->setAttribute("total_games", $games->getTotal());
	}
}
