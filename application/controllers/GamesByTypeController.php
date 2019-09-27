<?php
require_once("application/models/dao/GameTypes.php");
require_once("application/models/dao/GameManufacturers.php");
require_once("application/models/GameSortCriteria.php");
require_once("application/models/dao/GamesMenu.php");
require_once("BaseController.php");
require_once("application/models/caching/GamesListKey.php");
require_once("application/models/orm/GamesByType.php");

/*
* Games list by game type.
*
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/cde70121-39ba-4e3e-bb0f-d39a534d5f5c/Game-list?fullscreen
* @pathParameter type string Name of game type
*/
class GamesByTypeController extends BaseController
{
    public function service()
    {
        $this->response->attributes("selected_entity", ucwords($this->getSelectedEntity()));

        $menu = new GamesMenu($this->response->attributes("selected_entity"));
        $this->response->attributes("menu_bottom", $menu->getEntries());

        $object = new GameManufacturers();
        $this->response->attributes("software", $object->getAll());

        $results = $this->getResults();
        $this->response->attributes("total_games", $results["total"]);
        $this->response->attributes("games", $results["list"]);

        $this->response->attributes("filter", array("game_type"=>$this->response->attributes("selected_entity")));
    }


    private function getResults()
    {
        $driver = new \CasinosLists\GamesByType(
            $this->request->attributes("validation_results")->get("type"),
            [],
            $this->request->attributes("is_mobile"),
            GameSortCriteria::NONE,
            0
        );
        return $driver->getResults();
    }

    private function getSelectedEntity()
    {
        $parameter = $this->request->getValidator()->parameters("type");
        $param = $parameter == 'classic-slots' ? 'slots' : $parameter;
        $name = strtolower(str_replace("-", " ", $param));
        return $name;
    }

    protected function pageInfo()
    {
        // get page info
        $object = new PageInfoDAO();
        $total_games = !empty($this->response->attributes("total_games")) ? $this->response->attributes("total_games") : '';
        $this->response->attributes("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), $this->response->attributes("selected_entity"), $total_games));
    }
}
