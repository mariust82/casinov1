<?php
require_once("application/models/CasinoFilter.php");
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/dao/CasinosList.php");
require_once("application/models/dao/TopMenu.php");
require_once("application/models/dao/PageInfoDAO.php");
require_once("application/controllers/BaseController.php");
require_once("application/models/caching/CasinosListKey.php");
require_once("application/models/orm/GamesFeaturedList.php");
require_once("application/models/caching/GamesListKey.php");

/*
* Homepage
*
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/8735ce6f-75af-4583-8dca-6b3c775399c6/Software-page?fullscreen
*/
class IndexController extends BaseController
{
    public function service()
    {
        $this->response->attributes('is_mobile', $this->request->attributes("is_mobile"));
        $this->response->attributes("best_casinos", $this->getCasinos(array("label"=>"Best"), CasinoSortCriteria::TOP_RATED, 10));
        $this->response->attributes("country_casinos", $this->getCasinos(array("country_accepted"=>1), CasinoSortCriteria::POPULARITY, 5));
        $this->response->attributes("casinos_per_country", $this->countCasinosByCountry(array("country_accepted"=>1)));
        $this->response->attributes("new_casinos", $this->getCasinos([], CasinoSortCriteria::NEWEST, 5));
        $this->response->attributes("no_deposit_casinos", $this->getCasinos(
            array("bonus_type"=>"no deposit bonus"),
            CasinoSortCriteria::NEWEST,
            5
        ));
        $this->response->attributes("new_games", $this->getGames());
        $this->response->attributes("filter", null);
        $this->response->attributes("page_type", "index");
        $this->response->attributes("selected_entity", "index");
    }

    private function getCasinos($filter, $sortBy, $limit)
    {
        $object = new CasinosList(new CasinoFilter($filter, $this->request->attributes("country")));
        $results = $object->getResults($sortBy, 0, $limit);
        if (empty($results)) {
            unset($filter["country_accepted"]);
            $object = new CasinosList(new CasinoFilter($filter, $this->request->attributes("country")));
            $results = $object->getResults($sortBy, 0, $limit);
        }
        return $results;
    }

    private function countCasinosByCountry($filter)
    {
        $object = new CasinosList(new CasinoFilter($filter, $this->request->attributes("country")));
        $results = $object->getTotal();
        if (empty($results)) {
            $results = 0;
        }
        return $results;
    }

    private function getGames()
    {
        $driver = new \CasinosLists\GamesFeaturedList($this->request->attributes("is_mobile"));
        return $driver->getResults();
    }

    protected function pageInfo()
    {
        $object = new PageInfoDAO();
        $this->response->attributes("page_info", $object->getInfoByURL($this->request->getValidator()->getPage()));
    }

    protected function getWidgets()
    {
        $object = new \CMS\ContentManager();
    }
}
