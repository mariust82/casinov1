<?php
require_once("application/models/CasinoFilter.php");
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/dao/CasinosList.php");
require_once("application/models/dao/CasinosMenu.php");
require_once("BaseController.php");
require_once("application/models/caching/CacheManager.php");
require_once("application/models/caching/CacheKeyAdvanced.php");

abstract class CasinosListController extends BaseController {
	public function service() {
	    //die($this->application->getAttribute("parent_schema"));
        $this->response->setAttribute("selected_entity", $this->getSelectedEntity());
        $this->response->setAttribute('is_mobile',$this->request->getAttribute("is_mobile"));

        $menuBottom = new CasinosMenu($this->request->getAttribute("country")->name, $this->response->getAttribute("selected_entity"), $this->request->getURI()->getPage());
        $this->response->setAttribute("menu_bottom", $menuBottom->getEntries());

        $this->response->setAttribute("country", $this->request->getAttribute("country"));

        $this->response->setAttribute("sort_criteria", $this->getSortCriteria());
        $this->response->setAttribute("filter", $this->getFilter());

        $results = $this->getResults();
        $this->response->setAttribute("total_casinos", $results["total"]);
        $this->response->setAttribute("casinos", $results["list"]);
    }

    private function getResults() {
        $cacheManager = new CacheManager(new CacheKeyAdvanced(
            "casinos_list",
            array(
                $this->response->getAttribute("filter") => $this->response->getAttribute("selected_entity"),
                "user_country"=>$this->request->getAttribute("country")
            ),
            $this->response->getAttribute("sort_criteria"),
            0,
            50
        ));
        if($results = $cacheManager->get()) {
            return $results;
        } else {
            $filter = new CasinoFilter(array($this->response->getAttribute("filter") => $this->response->getAttribute("selected_entity")), $this->request->getAttribute("country"));
            $object = new CasinosList($filter);
            $results = array();
            $results["total"] = $object->getTotal();
            $results["list"] = ($results["total"]>0?$object->getResults($this->response->getAttribute("sort_criteria"), 0):array());
            $cacheManager->set($results);
            return $results;
        }
    }

    abstract protected function getSelectedEntity();

	abstract protected function getFilter();

	protected function getSortCriteria() {
	    return CasinoSortCriteria::NONE;
    }

	protected function generatePathParameter($name) {
	    return strtolower(str_replace(" ", "-", $name));
    }

    protected function pageInfo(){
        // get page info
        $object = new PageInfoDAO();
        $this->response->setAttribute("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), $this->response->getAttribute("selected_entity")));
    }
}
