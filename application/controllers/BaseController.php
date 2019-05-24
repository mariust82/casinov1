<?php
require_once("application/models/dao/TopMenu.php");
require_once("application/models/dao/PageInfoDAO.php");
require_once("hlis/tms/src/TextsManager.php");

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

        $this->response->attributes()->set("tms", $this->getTMSVariables());
    }

    abstract protected function service();

    abstract protected function pageInfo();

    protected function getTMSVariables() {
        // gets variables path
        $xml = $this->application->getTag("application");
        $variables_folder = (string) $xml->paths->tms_variables;

        // gets parent schema
        $parent_schema = $this->application->attributes()->get("parent_schema");

        // gets texts
        $tms = new \TMS\TextsManager($variables_folder, array("request"=>$this->request, "response"=>$this->response), $parent_schema);
        return $tms->getTexts();
    }
}
