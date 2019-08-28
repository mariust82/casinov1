<?php
require_once("application/models/GameSortCriteria.php");
require_once("application/models/orm/GamesByType.php");

/*
* Filters games according to selections
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
* @requestParameter type string Value of current game type
* @requestParameter filter_by string Name of game manufacturer (software)
* @requestParameter sort string Value can be "default", "top rated" or "newest"
*/
class GamesFilterController extends Lucinda\MVC\STDOUT\Controller
{
    const LIMIT = 24;
    public function run()
    {
        $validationResults = $this->request->attributes("validation_results");

        $driver = new \CasinosLists\GamesByType(
            $validationResults->get("game_type"),
            $validationResults->get("software"),
            $this->request->attributes("is_mobile"),
            $validationResults->get("sort")?$validationResults->get("sort"):GameSortCriteria::NONE,
            $this->request->getValidator()->parameters("page")+1
        );
        $results = $driver->getResults();
        $this->response->attributes("total_games", $results["total"]);
        $this->response->attributes("games", $results["list"]);
    }
}
