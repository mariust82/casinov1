<?php
require_once("application/models/CasinoFilter.php");
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/dao/CasinosList.php");
require_once("application/models/dao/TopMenu.php");
require_once("application/models/dao/CasinosMenu.php");

abstract class CasinosListController extends Controller {
	public function run() {
        $this->response->setAttribute("selected_entity", $this->getSelectedEntity());

        $menuTop = new TopMenu($this->request->getValidator()->getPage());
        $this->response->setAttribute("menu_top", $menuTop->getEntries());

        $menuBottom = new CasinosMenu($this->request->getAttribute("country")->name, $this->response->getAttribute("selected_entity"), $this->request->getURI()->getPage());
        $this->response->setAttribute("menu_bottom", $menuBottom->getEntries());

		$this->response->setAttribute("menu", $this->getMenu());

        $this->response->setAttribute("country", $this->request->getAttribute("country"));

        $object = new CasinosList($this->getFilter());
        $total = $object->getTotal();
        if($total>0) {
            $this->response->setAttribute("total_casinos", $total);
            $this->response->setAttribute("casinos", $object->getResults(CasinoSortCriteria::NONE, 0));
        } else {
            $this->response->setAttribute("total_casinos", 0);
            $this->response->setAttribute("casinos", array());
        }
    }

    abstract protected function getSelectedEntity();

	protected function getMenu() {
	    $countryName = $this->request->getAttribute("country")->name;
	    $entityName = $this->response->getAttribute("selected_entity");
	    return [
	        "/countries-list/".$this->generatePathParameter($countryName)=>$countryName." Casinos",
            "/".$this->request->getURI()->getPage()=>$entityName." Casinos",
            "/bonus-list/no-deposit-bonus"=>"No Deposit Casinos",
            "/casinos/best"=>"Best Casinos",
            "/casinos/safe"=>"Safe Casinos",
            "/casinos/new"=>"New Casinos",
            "/casinos/recommended"=>"Recommended Casinos",
            "/casinos/stay-away"=>"Stay Away Casinos",
        ];
    }

	abstract protected function getFilter();

	protected function generatePathParameter($name) {
	    return strtolower(str_replace(" ", "-", $name));
    }
}
