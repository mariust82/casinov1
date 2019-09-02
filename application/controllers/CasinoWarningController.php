<?php
require_once("application/models/dao/Casinos.php");
require_once("application/models/CasinoFilter.php");
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/dao/CasinosList.php");
require_once("application/models/dao/CasinosMenu.php");
require_once("BaseController.php");
/*
* Warning page to display about some casinos.
*
* @requestMethod GET
* @responseFormat HTML
* @source
* @pathParameter name string Name of casino
*/
class CasinoWarningController extends BaseController
{
    public function service()
    {
        if ($this->request->getValidator()->parameters('name')!= strtolower($this->request->getValidator()->parameters('name'))) {
            header(strtolower("Location:".$this->request->getValidator()->parameters('name')), true, 301);
        }
        $this->response->attributes("country", $this->request->attributes("country"));

        // set casino info
        $casinos = new Casinos();
        $result = $casinos->getBasicInfo($this->request->attributes('validation_results')->get('name'));
        if (!$result) {
            throw new Lucinda\MVC\STDOUT\PathNotFoundException();
        }

        $this->response->attributes("casino", $result);

        // get recommended casinos
        $object = new CasinosList(new CasinoFilter(array("software"=>$result->softwares, "country_accepted"=>true,"promoted"=>true), $this->request->attributes("country")));
        $this->response->attributes("recommended_casinos", $object->getResults(CasinoSortCriteria::NONE, 0, 5));
        $this->response->attributes('is_mobile', $this->request->attributes("is_mobile"));
        $this->response->attributes("page_type", "warning");
        $this->response->attributes("selected_entity", "warning");
    }

    private function getSelectedEntity()
    {
        return str_replace("-", " ", $this->request->getValidator()->parameters("name"));
    }

    protected function pageInfo()
    {
        // get page info
        $object = new PageInfoDAO();
        $this->response->attributes("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), $this->response->attributes("casino")->name));
    }
}
