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
class GamesFilterController extends Controller {

    public function run() {
        $page = (integer) $this->request->getValidator()->getPathParameter("page");
        $object = new GamesList(new GameFilter($_GET));

        if($page==0) {
            $total = $object->getTotal();
            if($total) {
                $this->response->setAttribute("total_games", $total);
                $this->response->setAttribute("games", $object->getResults((isset($_GET["sort"]) ? $_GET["sort"] : GameSortCriteria::NONE), $page));
            } else {
                $this->response->setAttribute("total_games", 0);
                $this->response->setAttribute("games", array());
            }
        } else {
            $this->response->setAttribute("total_games", 0);
            $this->response->setAttribute("games", $object->getResults((isset($_GET["sort"]) ? $_GET["sort"] : GameSortCriteria::NONE), $page));
        }
    }
}
