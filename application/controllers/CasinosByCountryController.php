<?php
require_once("application/models/dao/Countries.php");
require_once("CasinosListController.php");
/*
* Casinos list by country
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
* @pathParameter name string Name of country
*/
class CasinosByCountryController extends CasinosListController {
    protected function getSelectedEntity()
    {
        $parameter = $this->request->getValidator()->getPathParameter("name");
        if(!$parameter) {
            throw new PathNotFoundException();
        }
        $parameter = str_replace("-"," ", $parameter);
        $object = new Countries();
        $name = $object->validate($parameter);
        if(!$name) {
            throw new PathNotFoundException();
        }
        return $name;
    }

    protected function getFilter()
    {
        return new CasinoFilter(array("country"=>$this->response->getAttribute("selected_entity")), $this->request->getAttribute("country"));
    }
}
