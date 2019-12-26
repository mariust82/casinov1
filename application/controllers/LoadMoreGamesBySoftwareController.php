<?php
require_once("application/models/GameSortCriteria.php");
require_once("application/models/orm/GamesBySoftware.php");

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
class LoadMoreGamesBySoftwareController extends Lucinda\MVC\STDOUT\Controller
{
    public function run()
    {
        $limit = $this->request->attributes("is_mobile") ? 4 : 8;
        $driver = new \CasinosLists\GamesBySoftware(
            $this->request->parameters("software"),
            $limit,
            $this->request->getValidator()->parameters("page")
        );
        $results = $driver->getResults();
        $this->response->attributes("total_games", $results["total"]);
        $this->response->attributes("games", $results["list"]);
    }
}
