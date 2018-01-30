<?php
require_once("application/models/dao/GameInfo.php");
require_once("application/models/dao/GamesList.php");
require_once("application/models/GamePlayer.php");
require_once("application/models/dao/CasinosList.php");
require_once("application/models/CasinoFilter.php");
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/GameFilter.php");
require_once("application/models/GameSortCriteria.php");

/*
* Game info by game name.
* 
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/6735bd8e-75bb-415b-8204-66d6dca9122f/Single-Game-Page?fullscreen
* @pathParameter name string Name of game
*/
class GameInfoController extends Controller {
	public function run() {
	    $info = $this->application->getXML()->gameplay;

        $object = new GameTypes();
        $this->response->setAttribute("game_types", array_keys($object->getGamesCount()));

	    $object = new GameInfo(
	        str_replace("-"," ", $this->request->getValidator()->getPathParameter("name")),
            new GamePlayer((string) $info["repo_path"], (string) $info["width"], (string) $info["height"], $this->request->getProtocol()=="https"));
        $result = $object->getResult();
        if(!$result) throw new PathNotFoundException();
		$this->response->setAttribute("game", $result);

        $object = new CasinosList(new CasinoFilter(array("software"=>$result->software, "country_accepted"=>true), $this->request->getAttribute("country")));
        $this->response->setAttribute("recommended_casinos", $object->getResults(CasinoSortCriteria::NONE, 0,5));

        $object = new GamesList(new GameFilter(array("game_type"=>$result->type)));
        $this->response->setAttribute("recommended_games", $object->getResults(GameSortCriteria::NONE, 0, 6));
	}
}
