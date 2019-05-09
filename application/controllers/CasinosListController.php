<?php
require_once("application/models/CasinoFilter.php");
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/dao/CasinosList.php");
require_once("application/models/dao/CasinosMenu.php");
require_once("BaseController.php");
require_once("application/models/caching/CasinosListKey.php");

abstract class CasinosListController extends BaseController {

    protected $limit = 100;


	public function service() {


        $this->response->setAttribute("selected_entity", ucwords($this->getSelectedEntity()));

        $this->response->setAttribute('is_mobile',$this->request->getAttribute("is_mobile"));

        $menuBottom = new CasinosMenu($this->request->getAttribute("country")->name, $this->response->getAttribute("selected_entity"), $this->request->getURI()->getPage());
        $this->response->setAttribute("menu_bottom", $menuBottom->getEntries());

        $this->response->setAttribute("country", $this->request->getAttribute("country"));

        $this->response->setAttribute("sort_criteria", $this->getSortCriteria());
        $this->response->setAttribute("filter", $this->getFilter());

        $results = $this->getResults();
        //$this->setSpecificFilter();
        $this->response->setAttribute("total_casinos", $results["total"]);
        $this->response->setAttribute("casinos", $results["list"]);
        $this->response->setAttribute("page_type",$this->get_page_type());
        $this->response->setAttribute('bonus_free_type',$this->getAbbreviation($this->response->getAttribute('casinos')));
    }

    private function getResults() {

        $filter = new CasinoFilter(
            array($this->response->getAttribute("filter") => $this->response->getAttribute("selected_entity")),
            $this->request->getAttribute("country"));

        $object = new CasinosList($filter);
        $results = array();
        $results["total"] = $object->getTotal();
        $results["list"] = ($results["total"]>0 ? $object->getResults($this->response->getAttribute("sort_criteria"), 1, $this->limit) : array());

        return $results;
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
        $total_casinos = !empty($this->response->getAttribute("total_casinos")) ? $this->response->getAttribute("total_casinos") : '';
        $this->response->setAttribute("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), $this->response->getAttribute("selected_entity"),$total_casinos ));
    }

    private function get_page_type()
    {
        $position = strpos($_SERVER["REQUEST_URI"],"/",1);
        $url = ($position?substr($_SERVER["REQUEST_URI"],1, $position-1):$_SERVER["REQUEST_URI"]);
        $page = substr($_SERVER["REQUEST_URI"], $position+1);
        if ($page === 'no-deposit-bonus') {
            return 'free_bonus';
        }
        switch ($url) {
            case 'casinos':
                $piece = 'label';
                break;
            case 'softwares':
                $piece = 'software';
                break;
            case 'bonus-list':
                $piece = 'bonus_type';
                break;
            case 'countries-list':
                $piece = 'country';
                break;
            case 'banking':
                $piece = 'banking_method';
                break;
            case 'features':
                $piece = 'feature';
                break;
        }
        return $piece;
    }

    private function getAbbreviation($casinos)
    {
        $abbr = array();
        $index = 0;
        foreach ($casinos as $casino) {

            $abbr[$index] = null;
            if($casino->bonus_free) {
                $name = $casino->bonus_free->type;

                $words = explode(" ", $name);
                foreach ($words as $word) {
                    $abbr[$index] .= $word[0];
                }
            }
            $index++;
        }
        return $abbr;
    }

    private function setSpecificFilter()
    {
        if($this->getFilter()=="label")
            $this->response->setAttribute("filter",$this->response->getAttribute('selected_entity'));
        else
            $this->response->setAttribute("filter", $this->getFilter());
    }
}
