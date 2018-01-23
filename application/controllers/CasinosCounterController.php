<?php
/**
 * Controller
 */
abstract class CasinosCounterController extends Controller {
	public function run() {
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
