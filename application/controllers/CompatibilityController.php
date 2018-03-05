<?php
require_once("application/models/dao/OperatingSystems.php");
require_once("application/models/dao/PlayVersions.php");
require_once("application/models/dao/TopMenu.php");
require_once("application/models/dao/PageInfoDAO.php");

/*
* Operating system and play version list by number of casinos.
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
*/
class CompatibilityController extends Controller {
	public function run()
    {
        $menu = new TopMenu($this->request->getValidator()->getPage());
        $this->response->setAttribute("menu_top", $menu->getEntries());

        $this->response->setAttribute("results", $this->getResults());

        $object = new PageInfoDAO();
        $this->response->setAttribute("page_info", $object->getInfoByURL($this->request->getValidator()->getPage()));
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
}
