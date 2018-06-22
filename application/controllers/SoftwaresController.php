<?php
require_once("application/models/dao/GameManufacturers.php");
require_once("application/controllers/CasinosCounterController.php");

/*
* Software list by number of casinos.
* 
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/2d8654a1-8033-4b0c-b193-aaaf41785d65/Software-Lists?fullscreen
*/
class SoftwaresController extends Controller {

    public function run() {
        $menu = new TopMenu($this->request->getValidator()->getPage());
        $this->response->setAttribute("menu_top", $menu->getEntries());

        $object = new GameManufacturers();
        $results = $object->getCasinosCount();

        $this->response->setAttribute("results", $results);
        $this->response->setAttribute("icons", $object->getSoftwareByType());


        $object = new PageInfoDAO();
        $this->response->setAttribute("page_info", $object->getInfoByURL($this->request->getValidator()->getPage()));

    }

}
