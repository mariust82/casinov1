<?php
/**
 * Created by PhpStorm.
 * User: Alexandru.D
 * Date: 6/22/2018
 * Time: 5:39 PM
 */
require_once("application/models/dao/TopMenu.php");
require_once("application/models/dao/PageInfoDAO.php");

abstract class BaseController extends Controller {
    public function run() {
        $menu = new TopMenu($this->request->getValidator()->getPage());
        $this->response->setAttribute("menu_top", $menu->getEntries());

        $this->response->setAttribute("results", $this->getResults());

        $object = new PageInfoDAO();
        $this->response->setAttribute("page_info", $object->getInfoByURL($this->request->getValidator()->getPage()));

        $this->response->setAttribute("version", $this->application->getVersion());
    }

    abstract protected function getResults();
}