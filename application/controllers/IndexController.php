<?php
require_once("application/models/CasinoFilter.php");
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/dao/CasinosList.php");
require_once("application/models/GameFilter.php");
require_once("application/models/GameSortCriteria.php");
require_once("application/models/dao/GamesList.php");
require_once("application/models/dao/TopMenu.php");
require_once("application/models/dao/PageInfoDAO.php");
require_once("application/controllers/BaseController.php");
require_once("hlis/server_caching/src/CacheManager.php");
require_once("hlis/server_caching/src/CacheKeyAdvanced.php");

/*
* Homepage
* 
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/8735ce6f-75af-4583-8dca-6b3c775399c6/Software-page?fullscreen
*/
class IndexController extends BaseController {
	public function service() {
        $this->response->setAttribute("country", $this->request->getAttribute("country"));
        $this->response->setAttribute('is_mobile',$this->request->getAttribute("is_mobile"));
        $this->response->setAttribute("best_casinos", $this->getCasinos(array("promoted"=>1,"label"=>"Best"), CasinoSortCriteria::TOP_RATED, 10));
        $this->response->setAttribute("country_casinos", $this->getCasinos(array("country_accepted"=>1, "promoted"=>1), CasinoSortCriteria::POPULARITY, 5));
        $this->response->setAttribute("new_casinos", $this->getCasinos(array("country_accepted"=>1, "promoted"=>1), CasinoSortCriteria::NEWEST, 5));
        $this->response->setAttribute("no_deposit_casinos", $this->getCasinos(array("country_accepted"=>1, "promoted"=>1,"bonus_type"=>"No Deposit Bonus"), CasinoSortCriteria::NEWEST, 5));
        $this->response->setAttribute("new_games", $this->getGames(array("game_type"=>$this->response->getAttribute("selected_entity"), "is_mobile"=>$this->request->getAttribute("is_mobile")),GameSortCriteria::NEWEST, 6));
	}

	private function getCasinos($filter, $sortBy, $limit) {
	    $cacheManager = new CacheManager(new CacheKeyAdvanced(
            "casinos_list",
            ($filter+array("user_country"=>$this->request->getAttribute("country"))),
           $sortBy,
           0,
           $limit
        ));
	    if($results = $cacheManager->get()) {
	        return $results;
        } else {
            $object = new CasinosList(new CasinoFilter($filter, $this->request->getAttribute("country")));
            $results = $object->getResults($sortBy, 0,$limit);
            if(empty($results)) {
                unset($filter["country_accepted"]);
                $object = new CasinosList(new CasinoFilter($filter, $this->request->getAttribute("country")));
                $results = $object->getResults($sortBy, 0,$limit);
            }
            $cacheManager->set($results);
            return $results;
        }
    }

    private function getGames($filter, $sortBy, $limit) {
	    $cacheManager = new CacheManager(new CacheKeyAdvanced(
	        "games_list",
            $filter,
            $sortBy,
            0,
            $limit
        ));
        if($results = $cacheManager->get()) {
            return $results;
        } else {
            $game_filter = new GameFilter($filter);
            $object = new GamesList($game_filter);
            $results = $object->getResults($sortBy, 0,$limit);
            $cacheManager->set($results);
            return $results;
        }
    }

    protected function pageInfo(){
        $object = new PageInfoDAO();
        $this->response->setAttribute("page_info", $object->getInfoByURL($this->request->getValidator()->getPage()));
    }
}
