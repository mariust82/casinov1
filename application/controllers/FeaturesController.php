<?php
require_once("application/models/dao/PlayVersions.php");
require_once("application/models/dao/Certifications.php");
require_once("application/models/dao/Casinos.php");
require_once("BaseController.php");

/*
* Play versions by number of casinos.
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
*/
class FeaturesController extends BaseController {
    public function service() {
        $this->response->setAttribute("results", $this->getResults());
	}

	private function getResults() {
        $result = array();

        // get nr casinos for play version: live dealer
        $object = new PlayVersions();
        $result["Live Dealer"] = $object->getNumberOfCasinos("Live Dealer");

        // get nr casinos for certification: eCOGRA
        $object = new Certifications();
        $result["eCOGRA Casinos"] = $object->getNumberOfCasinos("eCOGRA");

        return $result;
    }

    protected function pageInfo(){
        $object = new PageInfoDAO();
        $this->response->setAttribute("page_info", $object->getInfoByURL($this->request->getValidator()->getPage()));
    }
}
