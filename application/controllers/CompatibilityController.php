<?php
require_once("application/models/dao/OperatingSystems.php");
require_once("application/models/dao/PlayVersions.php");
require_once("BaseController.php");

/*
* Operating system and play version list by number of casinos.
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
*/
class CompatibilityController extends BaseController {
	public function service(){
        $this->response->setAttribute("results", $this->getResults());
    }

    private function getResults() {
        $object = new OperatingSystems();
        $tmp1 = $object->getCasinosCount();
        $tmp1["iPhone"]=$tmp1["iOS"];
        unset($tmp1["iOS"]);
        $object = new PlayVersions();
        $tmp2 = $object->getCasinosCount();
        return array_merge($tmp1, $tmp2);
    }

    protected function pageInfo(){
        $object = new PageInfoDAO();
        $this->response->setAttribute("page_info", $object->getInfoByURL($this->request->getValidator()->getPage()));
    }
}
