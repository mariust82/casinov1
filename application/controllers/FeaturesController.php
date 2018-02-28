<?php
require_once("application/models/dao/PlayVersions.php");
require_once("application/models/dao/Certifications.php");
require_once("application/models/dao/Casinos.php");
require_once("application/models/dao/TopMenu.php");
require_once("application/models/dao/PageInfoDAO.php");

/*
* Play versions by number of casinos.
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
*/
class FeaturesController extends Controller {
    public function run() {
        $menu = new TopMenu($this->request->getValidator()->getPage());
        $this->response->setAttribute("menu_top", $menu->getEntries());

        $this->response->setAttribute("results", $this->getResults());

        $object = new PageInfoDAO();
        $this->response->setAttribute("page_info", $object->getInfoByURL($this->request->getValidator()->getPage()));
	}

	private function getResults() {
        $result = array();

        // get nr casinos for play version: live dealer
        $object = new PlayVersions();
        $result["Live Dealer"] = $object->getNumberOfCasinos("Live Dealer");

        // get nr casinos for certification: eCOGRA
        $object = new Certifications();
        $result["eCOGRA Casinos"] = $object->getNumberOfCasinos("eCOGRA");

        // get nr casinos for "High Roller"  (`prom_and_bon`+`support_level`)/2>7.3
        $object = new Casinos();
        $result["High Roller Casinos"] = $object->getHighRollerNumber();

        // get nr casinos for "Jackpot"
        $result["Jackpot Casinos"] = 0;
        return $result;
    }
}
