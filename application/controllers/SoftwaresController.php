<?php
require_once("application/models/dao/GameManufacturers.php");
require_once("BaseController.php");
/*
* Software list by number of casinos.
* 
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/2d8654a1-8033-4b0c-b193-aaaf41785d65/Software-Lists?fullscreen
*/
class SoftwaresController extends BaseController {

    public function service() {
        $object = $this->getCounter();
        $results = $object->getCasinosCount();
        $firstSoftware = array("RTG", "Rival", "NetEnt", "Playtech", "MicroGaming", "BetSoft", "Saucify", "Cryptologic", "IGT", "NYX Interactive", "NuWorks");
        $firstResults = [];
        foreach($firstSoftware as $software){
            if($results[$software]){
                $firstResults[$software] = $results[$software];
                unset($results[$software]);
            }
        }
        $results = $firstResults + $results;
        $this->response->setAttribute("results", $results);
    }

	protected function getCounter() {
        return new GameManufacturers();
    }

    protected function pageInfo(){
        $object = new PageInfoDAO();
        $this->response->setAttribute("page_info", $object->getInfoByURL($this->request->getValidator()->getPage()));
    }

}
