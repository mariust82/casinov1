<?php
require_once("application/models/dao/GamesList.php");
require_once("application/models/GameFilter.php");
require_once("application/models/GameSortCriteria.php");

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
class GamesFilterController extends Controller
{
    const LIMIT = 24;
    public function run()
    {

        $page = (integer)$this->request->getValidator()->getPathParameter("page");
        $sortBy = isset($_GET["sort"]) ? $_GET["sort"] : GameSortCriteria::NONE;


        $offset = $page * self::LIMIT;
        $object = new GamesList(new GameFilter($_GET));
        $total = $object->getTotal();
        $this->response->setAttribute("total_games", $total);
        $results = $object->getResults($sortBy, $page, self::LIMIT ,$offset);
        $this->response->setAttribute("games", $results, $page);

    }
}
