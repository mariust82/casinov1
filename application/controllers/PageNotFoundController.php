<?php
require_once("application/models/dao/PageInfoDAO.php");
require_once("application/models/dao/TopMenu.php");

class PageNotFoundController extends Lucinda\MVC\STDERR\Controller
{
    public function run()
    {
        if (strpos($this->response->headers("Content-Type"), "text/html")===false) {
            $this->response->attributes("class", get_class($this->request->getException()));
            return;
        }
        $object = new PageInfoDAO();
        $this->response->attributes("page_info", $object->getInfoByURL("404"));

        $this->response->attributes("use_bundle", in_array(ENVIRONMENT, ["dev","live"]));

        $this->response->attributes("version", (string)$this->application->getTag('application')['version']);

        $country = new Country();
        $country->code = "US";
        $country->name = "United States";

        $menu = new TopMenu("404", substr($_SERVER["REQUEST_URI"], 1), $country);
        $this->response->attributes("menu_top", $menu->getEntries());
    }
}
