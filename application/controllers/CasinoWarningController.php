<?php
require_once("application/models/dao/Casinos.php");
require_once("application/models/CasinoFilter.php");
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/dao/CasinosList.php");

/*
* Warning page to display about some casinos.
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
* @pathParameter name string Name of casino
*/
class CasinoWarningController extends Controller {
	public function run() {
	    // set casino info
		$casinos = new Casinos();
        $result = $casinos->getBasicInfo(str_replace("-"," ", $this->request->getValidator()->getPathParameter("name")));
		if(!$result) throw new PathNotFoundException();
		$this->response->setAttribute("casino", $result);

		// get recommended casinos
        $object = new CasinosList(new CasinoFilter(array("software"=>$result->softwares, "country_accepted"=>true), $this->request->getAttribute("country")));
        $this->response->setAttribute("recommended_casinos", $object->getResults(CasinoSortCriteria::NONE, 0,5));

        // set menu
        $this->response->setAttribute("menu", $this->getMenu());
    }

    protected function getMenu() {
        $countryName = $this->request->getAttribute("country")->name;
        return [
            "/countries-list/".strtolower(str_replace(" ", "-", $countryName))=>$countryName." Casinos",
            "/".$this->request->getURI()->getPage()=>$this->response->getAttribute("casino")->name,
            "/bonus-list/no-deposit-bonus"=>"No Deposit Casinos",
            "/casinos/best"=>"Best Casinos",
            "/casinos/safe"=>"Safe Casinos",
            "/casinos/new"=>"New Casinos",
            "/casinos/recommended"=>"Recommended Casinos",
            "/casinos/stay-away"=>"Stay Away Casinos",
        ];
    }
}
