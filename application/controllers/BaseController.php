<?php

require_once("application/models/dao/TopMenu.php");
require_once("application/models/dao/PageInfoDAO.php");

abstract class BaseController extends Controller {
    public function run() {

        $specificPage = $this->request->getURI()->getPage();
        $this->redirectPage($specificPage);

        $country = $this->request->getAttribute("country");
        $this->response->setAttribute("country", $country);
        $menu = new TopMenu($this->request->getValidator()->getPage(),$specificPage, $country);
        $this->response->setAttribute("menu_top", $menu->getEntries());

        $this->service();

        $this->pageInfo();

        $this->response->setAttribute("version", $this->application->getVersion());
    }

    private function redirectPage($page){
        switch ($page){
            case 'bonus-list/free-spins':
            case 'bonus-list/free-play':
            case 'bonus-list':
                header("Location: /bonus-list/no-deposit-bonus");
                break;
        }
    }

    abstract protected function service();

    abstract protected function pageInfo();
}