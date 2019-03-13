<?php
require_once("application/models/dao/GameInfo.php");
require_once("application/models/dao/GamesList.php");
require_once("application/models/dao/CasinosList.php");
require_once("application/models/CasinoFilter.php");
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/GameFilter.php");
require_once("application/models/GameSortCriteria.php");
require_once("application/models/dao/GameTypes.php");
require_once("application/models/dao/GamesMenu.php");
require_once ("BaseController.php");
/*
* Game info by game name.
* 
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/6735bd8e-75bb-415b-8204-66d6dca9122f/Single-Game-Page?fullscreen
* @pathParameter name string Name of game
*/
class GameInfoController extends BaseController {
	public function service() {
        $this->response->setAttribute("country", $this->request->getAttribute("country"));

	    $info = $this->application->getXML()->gameplay;

        $object = new GameTypes();
        $this->response->setAttribute("game_types", array_keys($object->getGamesCount()));

	    $object = new GameInfo($this->request->getAttribute('validation_results')->get('name'));
        $result = $object->getResult();
        if(!$result) throw new PathNotFoundException();
		$this->response->setAttribute("game", $result);

        $this->response->setAttribute("game_player", $this->getPlayerInfo());

        $object = new CasinosList(new CasinoFilter(array("software"=>$result->software, "country_accepted"=>true), $this->request->getAttribute("country")));
        $this->response->setAttribute("recommended_casinos", $object->getResults(CasinoSortCriteria::NONE, 0,5));
        $this->response->setAttribute('is_mobile',$this->request->getAttribute("is_mobile"));
        $object = new GamesList(new GameFilter(array("game_type"=>$result->type)));
        $this->response->setAttribute("recommended_games", $object->getResults(GameSortCriteria::NONE, 0, 6));

        $menuBottom = new GamesMenu($result->type);
        $this->response->setAttribute("menu_bottom", $menuBottom->getEntries());
    }

    private function getPlayerInfo() {
        $output = array();
        $xml = $this->application->getXML()->gameplay;
        $output["url"] = (string) $xml->{$this->application->getAttribute("environment")};
        $output["width"] = (string) $xml["width"];
        $output["height"] = (string) $xml["height"];
        return $output;
    }

    protected function pageInfo(){
        $object = new PageInfoDAO();
        $this->response->setAttribute("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), $this->response->getAttribute("game")->name));
    }
}
