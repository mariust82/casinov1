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
class CasinosFilterController extends Controller
{

    protected $limit = 100;

    public function run()
    {

        $this->response->setAttribute("country", $this->request->getAttribute("country"));
        $this->response->setAttribute('is_mobile', $this->request->getAttribute("is_mobile"));
        $sortCriteria = $this->getSortCriteria();

        $page = (integer)$this->request->getValidator()->getPathParameter("page");
        $filter = new CasinoFilter($_GET, $this->request->getAttribute("country"));
        $object = new CasinosList($filter);

        $total = $object->getTotal();

        $offset = $page * $this->limit;

        $this->response->setAttribute("filter",$filter->getCasinoLabel());
        $this->response->setAttribute("total_casinos", $total);
        $this->response->setAttribute("casinos", $object->getResults($sortCriteria, $page, $this->limit, $offset,true));
        $this->response->setAttribute('page_type',$this->getPageType($filter));
        $this->response->setAttribute('selected_entity','');
    }

    private function getSortCriteria()
    {
        $sort_criteria = $this->request->getAttribute('validation_results')->get('sort');
        if(empty($sort_criteria)|| $sort_criteria==null){
            return CasinoSortCriteria::NONE;
        }

        if($sort_criteria == CasinoSortCriteria::NONE){
            if($this->request->getParameter("label") == "New")
                return CasinoSortCriteria::NEWEST;
            else if($this->request->getParameter("label") == "Low Wagering")
                return CasinoSortCriteria::WAGERING;
            else if(!empty($this->request->getAttribute('validation_results')->get('country')))
                return CasinoSortCriteria::POPULARITY;
            return CasinoSortCriteria::NONE;
        }
        else{
            return $this->request->getAttribute('validation_results')->get('sort');
        }
    }

    private function getPageType(CasinoFilter $filter)
    {
        if($filter->getBankingMethod())
        {
            return 'banking_method';
        }
        else
        {
            if($filter->getCasinoLabel() == 'Low Wagering')
                return 'low_wagering';
            else
                return 'not_banking_method';
        }
    }
}
