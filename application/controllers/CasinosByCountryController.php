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
        $c_code = !empty($result[0]['c_code']) ? $result[0]['c_code'] : '';
        $language = !empty($result[0]['name']) ? $result[0]['name'] : '';
        $name =  !empty($result[0]['c_name']) ? $result[0]['c_name'] : '';
        $lang_id = !empty($result[0]['lang_id']) ? $result[0]['lang_id'] : '';
        $currency_id = !empty($result[0]['currency_id']) ? $result[0]['currency_id'] : '';
        $filter = new CasinoFilter(
            array($this->response->attributes("filter") => $this->response->attributes("selected_entity")),
            $this->request->attributes("country")
        );
        $dao = new CasinosList($filter);
        $this->response->attributes("country_id",$country_id);
        $this->response->attributes("user_country",$this->request->attributes("country")->name);
        $this->response->attributes("best_casinos_total", $dao->countBestCasinosByCountry($country_id));
        $this->response->attributes("best_casinos", $dao->getBestCasinosByCountry($country_id,$currency_id,$lang_id));
        $this->response->attributes("new_casinos_total", $dao->countNewestCasinosByCountry($country_id));
        $this->response->attributes("new_casinos", $dao->getNewestCasinosByCountry($country_id));
        $this->response->attributes("country_page", $name);
        $this->response->attributes("currency", $code);
        $this->response->attributes("country_code", $c_code);

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
