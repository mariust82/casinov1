<?php
require_once("application/models/dao/TopMenu.php");

class PrivacyController extends Controller
{
    public function run() {
        $menu = new TopMenu($this->request->getValidator()->getPage());
        $this->response->setAttribute("menu_top", $menu->getEntries());
    }
}