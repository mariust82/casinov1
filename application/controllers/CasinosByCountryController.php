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
        // TBD ...
        $parameter = $this->request->getValidator()->getPathParameter("name");
        $name = str_replace("-"," ", $parameter);

        $object = new Countries();
        $country_id =  $this->request->getAttribute('validation_results')->get('name');

        $result = $object->getCountryInfo($country_id);
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
