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
        if(!in_array($parameter,array("guinea-bissau","timor-leste"))) {
            $parameter = str_replace("-"," ", $parameter);
        }
        $object = new Countries();
        $name = $object->validate($parameter);
        if(!$name) {
            throw new PathNotFoundException();
        }
        $result = $object->getCountryDetails($name);
        $this->response->setAttribute("currency",$result[0]['code']);
        $this->response->setAttribute("language",$result[0]['name']);

        return $name;
    }

    protected function getFilter()
    {
        return "country";
    }

    protected function getSortCriteria() {
        return CasinoSortCriteria::POPULARITY;
    }
}
