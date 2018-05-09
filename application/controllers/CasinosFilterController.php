<?php
require_once("application/models/CasinoFilter.php");
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/dao/CasinosList.php");

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
class CasinosFilterController extends Controller {

	public function run() {
	    $this->response->setAttribute("country", $this->request->getAttribute("country"));
            $this->response->setAttribute('is_mobile',$this->request->getAttribute("is_mobile"));
        $sortCriteria = $this->getSortCriteria();
		$page = (integer) $this->request->getValidator()->getPathParameter("page");
        $object = new CasinosList(new CasinoFilter($_GET, $this->request->getAttribute("country")));
        if($page==0) {
            $total = $object->getTotal();
            if($total) {
                $this->response->setAttribute("total_casinos", $total);
                $this->response->setAttribute("casinos", $object->getResults($sortCriteria, $page,100,(100*$page)/2));
            } else {
                $this->response->setAttribute("total_casinos", 0);
                $this->response->setAttribute("casinos", array());
            }
        } else {
            $this->response->setAttribute("total_casinos", 0);
            $this->response->setAttribute("casinos", $object->getResults($sortCriteria, $page,100,(100*$page)/2));
        }
	}

	private function getSortCriteria() {
	    if($this->request->getParameter("sort")==CasinoSortCriteria::NONE && $this->request->getParameter("label")=="New") {
            return CasinoSortCriteria::NEWEST;
        } else {
            return $_GET["sort"];
        }
    }
}
