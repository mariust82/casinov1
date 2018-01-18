<?php
abstract class ParentsListController extends Controller {
	public function run() {
		$this->response->setAttribute("results", $this->getResults());
	}

	abstract protected function getResults();
}
