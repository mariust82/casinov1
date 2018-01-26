<?php
require_once("application/models/dao/GameTypes.php");
require_once("application/models/dao/GamesList.php");
require_once("application/models/GameFilter.php");
require_once("application/models/GameSortCriteria.php");

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
        $this->response->setAttribute("selected_entity", $this->getSelectedEntity()); // TODO: add me to doc!

        $object = new GameTypes();
        $this->response->setAttribute("game_types", array_keys($object->getGamesCount()));

        $object = new GamesList(new GameFilter(array("game_type"=>$this->response->getAttribute("selected_entity"))));
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
}
