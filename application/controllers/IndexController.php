<?php
require_once("application/models/CasinoFilter.php");
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/dao/CasinosList.php");
require_once("application/models/GameFilter.php");
require_once("application/models/GameSortCriteria.php");
require_once("application/models/dao/GamesList.php");
require_once("application/models/dao/TopMenu.php");

/*
* Homepage
* 
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/8735ce6f-75af-4583-8dca-6b3c775399c6/Software-page?fullscreen
*/
class IndexController extends Controller {
	public function run() {
	    $menu = new TopMenu($this->request->getValidator()->getPage());
	    $this->response->setAttribute("menu_top", $menu->getEntries());

        $this->response->setAttribute("country", $this->request->getAttribute("country"));

        $object = new CasinosList(new CasinoFilter(array("country_accepted"=>1, "promoted"=>1), $this->request->getAttribute("country")));
        $this->response->setAttribute("best_casinos", $object->getResults(CasinoSortCriteria::TOP_RATED, 0,10));

        $object = new CasinosList(new CasinoFilter(array("country_accepted"=>1, "promoted"=>1), $this->request->getAttribute("country")));
        $this->response->setAttribute("country_casinos", $object->getResults(CasinoSortCriteria::POPULARITY, 0,5));

        $object = new CasinosList(new CasinoFilter(array("country_accepted"=>1, "promoted"=>1), $this->request->getAttribute("country")));
        $this->response->setAttribute("new_casinos", $object->getResults(CasinoSortCriteria::NEWEST, 0,5));

        $object = new CasinosList(new CasinoFilter(array("country_accepted"=>1, "promoted"=>1,"bonus_type"=>"No Deposit Bonus"), $this->request->getAttribute("country")));
        $this->response->setAttribute("no_deposit_casinos", $object->getResults(CasinoSortCriteria::NEWEST, 0,5));

        $object = new GamesList(new GameFilter(array(), $this->request->getAttribute("country")));
        $this->response->setAttribute("new_games", $object->getResults(GameSortCriteria::NEWEST, 0,6));
	}
}
