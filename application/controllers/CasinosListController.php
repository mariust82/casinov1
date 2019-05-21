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

        $this->response->attributes()->set("selected_entity", ucwords($this->getSelectedEntity()));
        $this->response->attributes()->set('is_mobile',$this->request->attributes()->get("is_mobile"));

        $menuBottom = new CasinosMenu($this->request->attributes()->get("country")->name, $this->response->attributes()->get("selected_entity"), $this->request->getURI()->getPage());
        $this->response->attributes()->set("menu_bottom", $menuBottom->getEntries());
        $this->response->attributes()->set("country", $this->request->attributes()->get("country"));
        $this->response->attributes()->set("sort_criteria", $this->getSortCriteria());
        $this->response->attributes()->set("filter", $this->getFilter());

        $results = $this->getResults();
        $this->response->attributes()->set("total_casinos", $results["total"]);
        $this->response->attributes()->set("casinos", $results["list"]);
        $this->response->attributes()->set("page_type",$this->get_page_type());
        $this->response->attributes()->set('bonus_free_type',$this->getAbbreviation($this->response->attributes()->get('casinos')));
    }

    private function getResults() {

        $filter = new CasinoFilter(
            array($this->response->attributes()->get("filter") => $this->response->attributes()->get("selected_entity")),
            $this->request->attributes()->get("country"));

        $object = new CasinosList($filter);
        $results = array();
        $results["total"] = $object->getTotal();
        $results["list"] = ($results["total"]>0 ? $object->getResults($this->response->attributes()->get("sort_criteria"), 1, $this->limit) : array());

        return $results;
    }

    abstract protected function getSelectedEntity();

	abstract protected function getFilter();

    protected function getSortCriteria(){
        return CasinoSortCriteria::NONE;
    }

	protected function generatePathParameter($name) {
	    return strtolower(str_replace(" ", "-", $name));
    }

    protected function pageInfo(){
        // get page info
        $object = new PageInfoDAO();
        $total_casinos = !empty($this->response->attributes()->get("total_casinos")) ? $this->response->attributes()->get("total_casinos") : '';
        $this->response->attributes()->set("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), $this->response->attributes()->get("selected_entity"),$total_casinos ));
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
}
