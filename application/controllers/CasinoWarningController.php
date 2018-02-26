<?php
require_once("application/models/dao/Casinos.php");
require_once("application/models/CasinoFilter.php");
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/dao/CasinosList.php");
require_once("application/models/dao/TopMenu.php");
require_once("application/models/dao/CasinosMenu.php");

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
        $this->response->setAttribute("country", $this->request->getAttribute("country"));

        $menuTop = new TopMenu($this->request->getValidator()->getPage());
        $this->response->setAttribute("menu_top", $menuTop->getEntries());

	    // set casino info
		$casinos = new Casinos();
        $result = $casinos->getBasicInfo($this->getSelectedEntity());
		if(!$result) throw new PathNotFoundException();
		$this->response->setAttribute("casino", $result);

		// get recommended casinos
        $object = new CasinosList(new CasinoFilter(array("software"=>$result->softwares, "country_accepted"=>true), $this->request->getAttribute("country")));
        $this->response->setAttribute("recommended_casinos", $object->getResults(CasinoSortCriteria::NONE, 0,5));

        $menuBottom = new CasinosMenu($this->request->getAttribute("country")->name, $result->softwares, "softwares/".strtolower(str_replace(" ","-", $result->softwares)));
        $this->response->setAttribute("menu_bottom", $menuBottom->getEntries());
    }

    private function getSelectedEntity() {
        return str_replace("-"," ", $this->request->getValidator()->getPathParameter("name"));
    }
}
