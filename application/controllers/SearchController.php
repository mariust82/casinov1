<?php
require_once("application/models/dao/CasinosSearch.php");
require_once("application/models/dao/GamesSearch.php");
require_once("application/models/dao/ListsSearch.php");

/*
* Searches database for casinos and games
* 
* @requestMethod GET
* @responseFormat JSON
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/015eebd7-3b58-43a8-a8db-24dd6f810135/Search?fullscreen
* @requestParameter value string Value of searched string
*/
class SearchController extends Controller {
    const LIMIT = 3;
	public function run() {
        $lists = new ListsSearch($this->request->getParameter("value"));
	    $casinos = new CasinosSearch($this->request->getParameter("value"));
        $result = array_slice($lists->getResults(), 0, 3);
        $this->response->setAttribute("lists", $result);
	    $this->response->setAttribute("casinos", $casinos->getResults($this->limit,0));
            

        $games = new GamesSearch($this->request->getParameter("value"));
        $this->response->setAttribute("games", $games->getResults($this->limit,0));
	}
}
