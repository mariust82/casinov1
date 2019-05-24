<?php
require_once ("application/models/dao/PageInfoDAO.php");
require_once ("application/models/dao/TopMenu.php");

class PageNotFoundController extends Lucinda\MVC\STDERR\Controller {
    public function run(){
        $object = new PageInfoDAO();
        $this->response->setAttribute("page_info", $object->getInfoByURL("404"));

        $this->response->setAttribute("use_bundle", (in_array(ENVIRONMENT, ["dev","live"])?true:false));

        $this->response->setAttribute("version", (string)$this->application->getTag('application')['version']);

        $country = new Country();
        $country->code = "US";
        $country->name = "United States";

        $menu = new TopMenu("404", substr($_SERVER["REQUEST_URI"],1), $country);
        $this->response->setAttribute("menu_top", $menu->getEntries());
    }
}