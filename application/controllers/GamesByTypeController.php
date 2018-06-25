<?php
require_once("application/models/dao/GameTypes.php");
require_once("application/models/dao/GameManufacturers.php");
require_once("application/models/dao/GamesList.php");
require_once("application/models/GameFilter.php");
require_once("application/models/GameSortCriteria.php");
require_once("application/models/dao/GamesMenu.php");
require_once("BaseController.php");
/*
* Games list by game type.
* 
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/cde70121-39ba-4e3e-bb0f-d39a534d5f5c/Game-list?fullscreen
* @pathParameter type string Name of game type
*/
class GamesByTypeController extends BaseController {
	public function service() {
        $this->response->setAttribute("selected_entity", $this->getSelectedEntity());

        $menu = new GamesMenu($this->response->getAttribute("selected_entity"));
        $this->response->setAttribute("menu_bottom", $menu->getEntries());

        $object = new GameManufacturers();
        $this->response->setAttribute("software", $object->getAll());
        $is_mobile = $this->request->getAttribute("is_mobile");
        $game_filter = new GameFilter(array("game_type"=>$this->response->getAttribute("selected_entity")));
        if ($is_mobile) {
            $game_filter->is_mobile = TRUE;
        }
        $object = new GamesList($game_filter);
        $total = $object->getTotal();
        if($total>0) {
            $this->response->setAttribute("total_games", $total);
            $this->response->setAttribute("games", $object->getResults(GameSortCriteria::NONE, 0));
        } else {
            $this->response->setAttribute("total_games", 0);
            $this->response->setAttribute("games", array());
        }

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

    protected function pageInfo(){
        // get page info
        $object = new PageInfoDAO();
        $this->response->setAttribute("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), $this->response->getAttribute("selected_entity")));
    }

}
