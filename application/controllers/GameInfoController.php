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
        $this->response->attributes()->set("country", $this->request->attributes()->get("country"));

	    $info = $this->application->getTag("gameplay");

        $object = new GameTypes();
        $this->response->attributes()->set("game_types", array_keys($object->getGamesCount()));

	    $object = new GameInfo($this->request->attributes()->get('validation_results')->get('name'));
        $result = $object->getResult();
        if(!$result) throw new Lucinda\MVC\STDOUT\PathNotFoundException();
		$this->response->attributes()->set("game", $result);

        $this->response->attributes()->set("game_player", $this->getPlayerInfo());

        $object = new CasinosList(new CasinoFilter(array("software"=>$result->software, "country_accepted"=>true), $this->request->attributes()->get("country")));
        $this->response->attributes()->set("recommended_casinos", $object->getResults(CasinoSortCriteria::NONE, 0,5));
        $this->response->attributes()->set('is_mobile',$this->request->attributes()->get("is_mobile"));
        $object = new GamesList(new GameFilter(array("game_type"=>$result->type)));
        $this->response->attributes()->set("recommended_games", $object->getResults(GameSortCriteria::NONE, 0, 6));

        $menuBottom = new GamesMenu($result->type);
        $this->response->attributes()->set("menu_bottom", $menuBottom->getEntries());

        $this->response->attributes()->set("page_type", "game_info");
    }

    private function getPlayerInfo() {
        $output = array();
        $xml = $this->application->getTag("gameplay");
        $output["url"] = (string) $xml->{ENVIRONMENT};
        $output["width"] = (string) $xml["width"];
        $output["height"] = (string) $xml["height"];
        return $output;
    }

    protected function pageInfo(){
        $object = new PageInfoDAO();
        $this->response->attributes()->set("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), $this->response->attributes()->get("game")->name));
    }
}
