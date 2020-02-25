<?php
require_once("application/models/CasinoFilter.php");
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/dao/CasinosList.php");
require_once 'application/controllers/CasinosFilterController.php';

/*
* Filters casinos according to selections
*
* @requestMethod GET
* @responseFormat HTML
* @source
* @pathParameter page integer Results page for casinos.
* @requestParameter country_accepted boolean If (country) accepted filter is checked.
* @requestParameter free_bonus boolean If free bonus filter is checked.
* @requestParameter banking_method string Value of current banking method, if current page is "Banking"
* @requestParameter label string Value of current casino label, if  current page is "Casinos"
* @requestParameter bonus_type string Value of current bonus type, if  current page is "Bonuses"
* @requestParameter country string Value of current country, if current page is "Countries"
* @requestParameter operating_system string Value of current operating system, if  current page is "Compatibility"
* @requestParameter software string Value of current software, if  current page is "Software"
* @requestParameter play_version string Value of current play version, if  current page is "Features"
* @requestParameter sort string Value can be "default", "top rated" or "newest"
*/
class LoadAllCasinosController extends CasinosFilterController
{

    public function run()
    {
        $this->response->attributes("country", $this->request->attributes("country"));
        $this->response->attributes('is_mobile', $this->request->attributes("is_mobile"));
        $page = (integer)$this->request->getValidator()->parameters("page");
        $filter = new CasinoFilter($_GET, $this->request->attributes("country"));
        $object = new CasinosList($filter);

        $total = $object->getTotal();
        $free_bonus = $this->request->parameters('free_bonus');
        $country_accepted = $this->request->parameters('country_accepted');
        $sort = $this->request->parameters('sort');
        if ($free_bonus == NULL && $country_accepted == NULL && $sort == '1') {
            if ($page == 1) {
                $offset =  30;
            } else {
                $offset =  ($page -1) * $this->limit + 30;
            }
        } else {
            $offset = $page * $this->limit;
        }
        $this->response->attributes("filter", $filter->getCasinoLabel());
        $this->response->attributes("total_casinos", $total);
        $this->response->attributes("casinos", $object->getResults($sort, $page, $this->limit, $offset, true));
        $this->response->attributes('page_type', $this->getPageType($filter));
        $this->response->attributes('selected_entity', $filter->getCasinoLabel());
    }
}
