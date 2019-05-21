<?php
require_once("application/models/dao/Casinos.php");
require_once("application/models/CasinoFilter.php");
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/dao/CasinosList.php");
require_once("application/models/dao/CasinosMenu.php");
require_once("BaseController.php");
/*
* Warning page to display about some casinos.
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
* @pathParameter name string Name of casino
*/
class CasinoWarningController extends BaseController {
	public function service() {
        $this->response->attributes()->set("country", $this->request->attributes()->get("country"));

	    // set casino info
		$casinos = new Casinos();
        $result = $casinos->getBasicInfo($this->request->attributes()->get('validation_results')->get('name'));
		if(!$result) throw new Lucinda\MVC\STDOUT\PathNotFoundException();
		$this->response->attributes()->set("casino", $result);

		// get recommended casinos
        $object = new CasinosList(new CasinoFilter(array("software"=>$result->softwares, "country_accepted"=>true,"promoted"=>true), $this->request->attributes()->get("country")));
        $this->response->attributes()->set("recommended_casinos", $object->getResults(CasinoSortCriteria::NONE, 0,5));
        $this->response->attributes()->set('is_mobile',$this->request->attributes()->get("is_mobile"));

    }

    private function getSelectedEntity() {
        return str_replace("-"," ", $this->request->getValidator()->getPathParameter("name"));
    }

    protected function pageInfo(){
        // get page info
        $object = new PageInfoDAO();
        $this->response->attributes()->set("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), $this->response->attributes()->get("casino")->name));
    }
}
