<?php

require_once("application/models/dao/TopMenu.php");
require_once("application/models/dao/PageInfoDAO.php");

abstract class BaseController extends Controller {
    public function run() {

        $specificPage = $this->request->getURI()->getPage();
        $country = $this->request->getAttribute("country");
        $this->response->setAttribute("country", $country);
        $menu = new TopMenu($this->request->getValidator()->getPage(),$specificPage, $country);
        $this->response->setAttribute("menu_top", $menu->getEntries());

        $this->service();

        $this->pageInfo();

        $this->response->setAttribute("version", $this->application->getVersion());

        $this->response->setAttribute("use_bundle", (in_array($this->application->getAttribute("environment"), ["dev","live"])?true:false));
    }

    abstract protected function service();

    abstract protected function pageInfo();
}