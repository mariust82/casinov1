<?php
require_once("application/models/dao/GameTypes.php");
require_once("application/models/dao/GameManufacturers.php");
require_once("application/models/dao/GamesList.php");
require_once("application/models/GameFilter.php");
require_once("application/models/GameSortCriteria.php");
require_once("application/models/dao/TopMenu.php");
require_once("application/models/dao/GamesMenu.php");
require_once("application/models/dao/PageInfoDAO.php");

/*
* Games list by game type.
* 
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/cde70121-39ba-4e3e-bb0f-d39a534d5f5c/Game-list?fullscreen
* @pathParameter type string Name of game type
*/
class GamesByTypeController extends Controller {
	public function run() {
        $menu = new TopMenu($this->request->getValidator()->getPage());
        $this->response->setAttribute("menu_top", $menu->getEntries());

        $this->response->setAttribute("selected_entity", $this->getSelectedEntity());

        $menu = new GamesMenu($this->response->getAttribute("selected_entity"));
        $this->response->setAttribute("menu_bottom", $menu->getEntries());

        $object = new GameManufacturers();
        $this->response->setAttribute("software", $object->getAll());

        $object = new GamesList(new GameFilter(array("game_type"=>$this->response->getAttribute("selected_entity"))));
        $total = $object->getTotal();
        if($total>0) {
            $this->response->setAttribute("total_games", $total);
            $this->response->setAttribute("games", $object->getResults(GameSortCriteria::NONE, 0));
        } else {
            $this->response->setAttribute("total_games", 0);
            $this->response->setAttribute("games", array());
        }

        // get page info
        $object = new PageInfoDAO();
        $this->response->setAttribute("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), $this->response->getAttribute("selected_entity")));
	}

	private function getSelectedEntity(){
        $parameter = $this->request->getValidator()->getPathParameter("type");
        if(!$parameter) {
            throw new PathNotFoundException();
        }
        $parameter = strtolower(str_replace("-"," ", $parameter));
        $object = new GameTypes();
        $name = $object->validate($parameter);
        if(!$name) {
            throw new PathNotFoundException();
        }
        return $name;
    }
}
