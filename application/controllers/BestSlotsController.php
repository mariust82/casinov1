<?php
require_once("application/models/dao/GameTypes.php");
require_once("application/models/dao/GameManufacturers.php");
require_once("application/models/dao/GamesList.php");
require_once("application/models/GameFilter.php");
require_once("application/models/GameSortCriteria.php");
require_once("application/models/dao/GamesMenu.php");
require_once("BaseController.php");
require_once("application/models/caching/GamesListKey.php");

/*
* Games list by game type.
* 
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/cde70121-39ba-4e3e-bb0f-d39a534d5f5c/Game-list?fullscreen
* @pathParameter type string Name of game type
*/
class NewSlotsController extends BaseController {

    const LIMIT = 24;
    private $filter;

	public function service() {
        $this->response->setAttribute("selected_entity", 'Slots');
        $menu = new GamesMenu($this->response->getAttribute("selected_entity"));
        $this->response->setAttribute("menu_bottom", $menu->getEntries());

        $object = new GameManufacturers();
        $this->response->setAttribute("software", $object->getAll());
        $this->setFilter();
        $this->response->setAttribute("filter", $this->filter);
        $results = $this->getResults();
        $this->response->setAttribute("total_games", $results["total"]);
        $this->response->setAttribute("games", $results["list"]);
	}

	private function setFilter(){
        $this->filter = new GameFilter(array("game_type"=>$this->response->getAttribute("selected_entity"), "is_mobile"=>$this->request->getAttribute("is_mobile"), "is_best"=>TRUE));
    }


	private function getResults() {
        $object = new GamesList($this->filter);
        $results = array();
        $results["total"] = $object->getTotal();
        $results["list"] = ($results["total"]>0?$object->getResults(GameSortCriteria::NONE, 1, self::LIMIT):array());

        return $results;
    }

    protected function pageInfo(){
        // get page info
        $object = new PageInfoDAO();
        $this->response->setAttribute("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), $this->response->getAttribute("selected_entity")));
    }

}
