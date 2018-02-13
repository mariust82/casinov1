<?php
require_once("application/models/dao/TopMenu.php");

/**
 * Controller
 */
abstract class CasinosCounterController extends Controller {
	public function run() {
        $menu = new TopMenu($this->request->getValidator()->getPage());
        $this->response->setAttribute("menu_top", $menu->getEntries());

	    $object = $this->getCounter();
		$this->response->setAttribute("results", $object->getCasinosCount());
	}

    /**
     * Gets counter instance
     *
     * @return CasinoCounter
     */
	abstract protected function getCounter();
}
