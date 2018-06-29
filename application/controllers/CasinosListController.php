<?php
require_once("application/models/CasinoFilter.php");
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/dao/CasinosList.php");
require_once("application/models/dao/CasinosMenu.php");
require_once("BaseController.php");

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

        $filter = new CasinoFilter(array($this->response->getAttribute("filter") => $this->response->getAttribute("selected_entity")), $this->request->getAttribute("country"));
        $object = new CasinosList($filter);
        $total = $object->getTotal();
        if($total>0) {
            $this->response->setAttribute("total_casinos", $total);
            $this->response->setAttribute("casinos", $object->getResults($this->response->getAttribute("sort_criteria"), 0));
        } else {
            $this->response->setAttribute("total_casinos", 0);
            $this->response->setAttribute("casinos", array());
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
