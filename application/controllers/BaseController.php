<?php
require_once("application/models/dao/TopMenu.php");
require_once("application/models/dao/PageInfoDAO.php");

abstract class BaseController extends Lucinda\MVC\STDOUT\Controller {
    public function run() {
        $specificPage = $this->request->getURI()->getPage();
        $country = $this->request->attributes()->get("country");
        $this->response->attributes()->set("country", $country);
        $menu = new TopMenu($this->request->getValidator()->getPage(),$specificPage, $country);
        $this->response->attributes()->set("menu_top", $menu->getEntries());

        $this->service();

        $this->pageInfo();

        $this->response->attributes()->set("version", $this->application->getVersion());

        $this->response->attributes()->set("use_bundle", (in_array(ENVIRONMENT, ["dev","live"])?true:false));
    }

    abstract protected function service();

    abstract protected function pageInfo();
}