<?php
require_once("application/models/CasinoFilter.php");
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/dao/CasinosList.php");
require_once("application/models/GameFilter.php");
require_once("application/models/GameSortCriteria.php");
require_once("application/models/dao/GamesList.php");
require_once("application/models/dao/TopMenu.php");
require_once("application/models/dao/PageInfoDAO.php");

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
        $this->response->setAttribute('is_mobile',$this->request->getAttribute("is_mobile"));
        $this->response->setAttribute("best_casinos", $this->getCasinos(array("country_accepted"=>1, "promoted"=>1), CasinoSortCriteria::TOP_RATED, 10));
        $this->response->setAttribute("country_casinos", $this->getCasinos(array("country_accepted"=>1, "promoted"=>1), CasinoSortCriteria::POPULARITY, 5));
        $this->response->setAttribute("new_casinos", $this->getCasinos(array("country_accepted"=>1, "promoted"=>1), CasinoSortCriteria::NEWEST, 5));
        $this->response->setAttribute("no_deposit_casinos", $this->getCasinos(array("country_accepted"=>1, "promoted"=>1,"bonus_type"=>"No Deposit Bonus"), CasinoSortCriteria::NEWEST, 5));
        $is_mobile = $this->request->getAttribute("is_mobile");
        $game_filter = new GameFilter(array("game_type"=>$this->response->getAttribute("selected_entity")));
        if ($is_mobile) {
            $game_filter->is_mobile = TRUE;
        }
        $object = new GamesList($game_filter);
        $this->response->setAttribute("new_games", $object->getResults(GameSortCriteria::NEWEST, 0,6));

        $object = new PageInfoDAO();
        $this->response->setAttribute("page_info", $object->getInfoByURL($this->request->getValidator()->getPage()));
	}

	private function getCasinos($filter, $sortBy, $limit) {
        $object = new CasinosList(new CasinoFilter($filter, $this->request->getAttribute("country")));
        $results = $object->getResults($sortBy, 0,$limit);
        if(empty($results)) {
            unset($filter["country_accepted"]);
            $object = new CasinosList(new CasinoFilter($filter, $this->request->getAttribute("country")));
            $results = $object->getResults($sortBy, 0,$limit);
        }
        return $results;
    }
}
