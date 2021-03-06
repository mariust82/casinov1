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
class CasinosFilterController extends Lucinda\MVC\STDOUT\Controller
{
    protected $limit = 100;

    public function run()
    {
        $this->response->attributes("list_view", $this->request->parameters("list_view") );
        $this->response->attributes("country", $this->request->attributes("country"));
        $this->response->attributes('is_mobile', $this->request->attributes("is_mobile"));

        $sortCriteria = $this->getSortCriteria();

        $page = (integer)$this->request->getValidator()->parameters("page");
        $filter = new CasinoFilter($_GET, $this->request->attributes("country"));
        $params = $this->request->parameters();
        $object = new CasinosList($filter);
        $total = $object->getTotal();
        $offset = isset($params['offset']) ? $params['offset'] : $this->setOffset($page);
        $this->response->attributes("filter", $filter->getCasinoLabel());
        $this->response->attributes("total_casinos", $total);
        $this->response->attributes("total_casinos_left", $total - $offset);
        $this->response->attributes("casinos", $object->getResults($sortCriteria, $page, $this->limit, $offset));
        $this->response->attributes('page_type', $this->getPageType($filter));
        $this->response->attributes('selected_entity', isset($params['free_bonus']) ? $params['free_bonus'] : $filter->getCasinoLabel());
    }
    
    private function setOffset($page) {
        $params = $this->request->parameters();
        if (isset($params["live_dealer"])) {
            $offset = $page == 0? 0:($page - 1) * $this->limit + 30;
        } elseif (isset($params["free_bonus"])) {
            $offset = $page == 0? 0:($page - 1) * $this->limit + 52;
        } elseif (isset($params["label"]) && $params["label"] == "Low Minimum Deposit") {
            $offset = $page == 0? 0:($page - 1) * $this->limit + 100;
        } else {
            $offset = $page == 0? 0:($page - 1) * $this->limit + 50;
        }
        
        return $offset;
    }

    private function getSortCriteria()
    {
        if ($this->request->parameters("label") == "Best") {
            return CasinoSortCriteria::TOP_RATED;
        }

        $sort_criteria = $this->request->attributes('validation_results')->get('sort');
        if (empty($sort_criteria)) {
            return CasinoSortCriteria::NONE;
        }

        if ($sort_criteria == CasinoSortCriteria::NONE) {
            if ($this->request->parameters("label") == "New") {
                return CasinoSortCriteria::NEWEST;
            } elseif ($this->request->parameters("label") == "Low Wagering") {
                return CasinoSortCriteria::WAGERING;
            } elseif ($this->request->parameters("label") == "Fast Payout") {
                return CasinoSortCriteria::FAST_PAYOUT;
            } elseif ($this->request->parameters("label") == "No Account Casinos") {
                return CasinoSortCriteria::NO_ACCOUNT;
            } elseif ($this->request->parameters("label") == "Low Minimum Deposit") {
                return CasinoSortCriteria::MINIMUM_DEPOSIT;
            } elseif (!empty($this->request->attributes('validation_results')->get('country'))) {
                return CasinoSortCriteria::POPULARITY;
            }
            return CasinoSortCriteria::NONE;
        } else {
            return $this->request->attributes('validation_results')->get('sort');
        }
    }

    protected function getPageType(CasinoFilter $filter)
    {
        if ($filter->getBankingMethod()) {
            return 'banking_method';
        } else {
            if ($filter->getCasinoLabel() == 'Low Wagering') {
                return 'low_wagering';
            } else {
                return 'not_banking_method';
            }
        }
    }
}
