<?php
require_once("application/models/dao/CasinosList.php");
require_once("application/models/CasinoFilter.php");
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/GameFilter.php");
require_once("application/models/GameSortCriteria.php");
require_once("application/models/dao/GameTypes.php");
require_once("application/models/dao/GamesMenu.php");
require_once("BaseController.php");
require_once("application/models/orm/GameInfo.php");
require_once("application/models/orm/GamesRecommended.php");
/*
* Game info by game name.
*
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/6735bd8e-75bb-415b-8204-66d6dca9122f/Single-Game-Page?fullscreen
* @pathParameter name string Name of game
*/
class GameInfoController extends BaseController
{
    public function service()
    {
        $this->response->attributes("country", $this->request->attributes("country"));
        var_dump($this->request->attributes("is_mobile"));
        $object = new GameTypes($this->request->attributes("is_mobile"));
        $this->response->attributes("game_types", array_keys($object->getGamesCount()));

        $object = new \CasinosLists\GameInfo($this->request->attributes('validation_results')->get('name'));
        $result = $object->getResults();
        $this->response->attributes("game", $result);

        $this->response->attributes("game_player", $this->getPlayerInfo());

        $object = new CasinosList(new CasinoFilter(array("software"=>$result->manufacturer, "country_accepted"=>true), $this->request->attributes("country")));
        $this->response->attributes("recommended_casinos", $object->getResults(CasinoSortCriteria::NONE, 0, 5));

        $this->response->attributes('is_mobile', $this->request->attributes("is_mobile"));

        $gfl = new \CasinosLists\GamesRecommended($this->request->attributes('validation_results')->get('name'), $result->type, $this->request->attributes("is_mobile"));
        $this->response->attributes("recommended_games", $gfl->getResults());

        $menuBottom = new GamesMenu($result->type);
        $this->response->attributes("menu_bottom", $menuBottom->getEntries());

        $this->response->attributes("page_type", "game_info");

        $this->response->attributes("selected_entity", "SOFTWARE");
    }

    private function getPlayerInfo()
    {
        $output = array();
        $xml = $this->application->getTag("gameplay");
        $output["url"] = (string) $xml->{ENVIRONMENT};
        $output["width"] = (string) $xml["width"];
        $output["height"] = (string) $xml["height"];
        return $output;
    }

    protected function pageInfo()
    {
        $object = new PageInfoDAO();
        $this->response->attributes("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), $this->response->attributes("game")->name));
    }
}
