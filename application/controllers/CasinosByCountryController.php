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
class CasinosByCountryController extends CasinosListController
{
    protected function getSelectedEntity()
    {
        $object = new Countries();
        $country_id =  $this->request->attributes('validation_results')->get('name');

        $result = $object->getCountryInfo($country_id);
        $code = !empty($result[0]['code']) ? $result[0]['code'] : '';
        $language = !empty($result[0]['name']) ? $result[0]['name'] : '';
        $name =  !empty($result[0]['c_name']) ? $result[0]['c_name'] : '';

        $this->response->attributes("currency", $code);
        $this->response->attributes("language", $language);

        return $name;
    }

    protected function getFilter()
    {
        return "country";
    }

    protected function getSortCriteria()
    {
        return CasinoSortCriteria::POPULARITY;
    }
}
