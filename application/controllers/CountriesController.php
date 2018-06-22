<?php
require_once("application/models/dao/Countries.php");
require_once("application/controllers/CasinosCounterController.php");

/*
* Countries list by number of casinos
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
*/
class CountriesController extends Controller {

    public function run() {
        $menu = new TopMenu($this->request->getValidator()->getPage());
        $this->response->setAttribute("menu_top", $menu->getEntries());

        $object = new Countries();
        $results = $object->getCasinosCount();
        //Make user country be first in list
        if(array_key_exists($this->request->getAttribute("country")->name, $results)){
            $userCountry = array($this->request->getAttribute("country")->name => $results[$this->request->getAttribute("country")->name]);
            unset($results[$this->request->getAttribute("country")->name]);
            $results = $userCountry + $results;
        }
        $this->response->setAttribute("results", $results);


        $object = new PageInfoDAO();
        $this->response->setAttribute("page_info", $object->getInfoByURL($this->request->getValidator()->getPage()));
    }

}
