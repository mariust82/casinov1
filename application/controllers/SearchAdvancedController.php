<?php
require_once("application/models/dao/ListsSearch.php");
require_once("application/models/dao/CasinosSearch.php");
require_once("application/models/dao/GamesSearch.php");

/*
* Page to display after show all results is clicked @ search page
*
* @requestMethod GET
* @responseFormat JSON
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/015eebd7-3b58-43a8-a8db-24dd6f810135/Search?fullscreen
* @requestParameter value string Value of searched string
*/
class SearchAdvancedController extends Lucinda\MVC\STDOUT\Controller
{
    const LIMIT = 5;

    public function run()
    {
        $this->response->attributes("value", $this->request->attributes('validation_results')->get('value'));

        $lists = new ListsSearch($this->request->attributes('validation_results')->get('value'));
        $result = $this->fixListsGamesBug($lists->getResults());
        $this->response->attributes("index", count($result) > 5 ? 5:  count($result));
        $this->response->attributes("lists", $result);
        $this->response->attributes("total_lists", count($result));

        $casinos = new CasinosSearch($this->request->attributes('validation_results')->get('value'));
        $this->response->attributes("casinos", $casinos->getResults(self::LIMIT, 0));
        $this->response->attributes("total_casinos", $casinos->getTotal());
        $games = new GamesSearch($this->request->attributes('validation_results')->get('value'));
        $this->response->attributes("games", $games->getResults(self::LIMIT, 0));
        $this->response->attributes("total_games", $games->getTotal());
    }

    private function fixListsGamesBug($lists)
    {
        for ($i=0;$i<count($lists);$i++) {
            if ($lists[$i]['url'] == "games/(type)") {
                $lists[$i]['url'] = str_replace("(type)", $this->normalizeTitleName($lists[$i]['name']), $lists[$i]['url']);
            }
        }
        return $lists;
    }

    private function normalizeTitleName($name)
    {
        $str = str_replace(" ", "-", $name);
        $str = str_replace("#", "-", $str);
        return strtolower($str);
    }
}
