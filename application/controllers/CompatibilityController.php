<?php
require_once("application/models/dao/OperatingSystems.php");
require_once("application/models/dao/PlayVersions.php");
require_once("application/models/dao/TopMenu.php");

/*
* Operating system and play version list by number of casinos.
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
*/
class CompatibilityController extends Controller {
	public function run()
    {
        $menu = new TopMenu($this->request->getValidator()->getPage());
        $this->response->setAttribute("menu_top", $menu->getEntries());

        $object = new OperatingSystems();
        $tmp1 = $object->getCasinosCount();

        $object = new PlayVersions();
        $tmp2 = $object->getCasinosCount();

        $this->response->setAttribute("results", array_merge($tmp1, $tmp2));
    }
}
