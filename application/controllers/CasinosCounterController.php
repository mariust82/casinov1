<?php
require_once("application/models/dao/TopMenu.php");
require_once("application/models/dao/PageInfoDAO.php");

/**
 * Controller
 */
abstract class CasinosCounterController extends Controller {
	public function run() {
        $menu = new TopMenu($this->request->getValidator()->getPage());
        $this->response->setAttribute("menu_top", $menu->getEntries());

	    $object = $this->getCounter();
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

    /**
     * Gets counter instance
     *
     * @return CasinoCounter
     */
	abstract protected function getCounter();
}
