<?php
require_once("application/models/dao/BankingMethods.php");
require_once("CasinosListController.php");

/*
* Casinos list by banking method
*
* @requestMethod GET
* @responseFormat HTML
* @source
* @pathParameter name string Name of banking method
*/
class CasinosByBankingMethodController extends CasinosListController
{
    private $bankingMethod;
    
    protected function pageInfo()
    {
        // get page info
        $object = new PageInfoDAO();
        $total_casinos = !empty($this->response->attributes("total_casinos")) ? $this->response->attributes("total_casinos") : '';
        $this->response->attributes("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), $this->bankingMethod->name, $total_casinos));
    }
        
    protected function getSelectedEntity()
    {
        $parameter = $this->request->getValidator()->parameters("name");
        $name = str_replace("-", " ", $parameter);
        $banking = new BankingMethods();
        $this->bankingMethod = $banking->getInfo($name);
        return $this->bankingMethod->id;
    }
    
    private function getCasinos($filter, $sortBy, $limit)
    {
        $casinoFilter = new CasinoFilter($filter, $this->request->attributes("country"));
        $casinoFilter->setBankingMethod($this->bankingMethod->id);
        $casinoFilter->setPromoted(TRUE);
        $casinoFilter->setCountryAccepted(TRUE);
        $object = new CasinosList($casinoFilter);
        $results = $object->getResults($sortBy, 0, $limit);
        $total = $object->getTotal();
        return ['total'=>$total,'result'=>$results];
    }
    
    protected function init() {
        $parameter = $this->request->getValidator()->parameters("name");
        $name = str_replace("-", " ", $parameter);
        $banking = new BankingMethods();
        $this->bankingMethod = $banking->getInfo($name);
                
        $casinos = $this->getCasinos([], CasinoSortCriteria::TOP_RATED, 5);
        $banking = new BankingMethods();
        $this->response->attributes("banking", $this->bankingMethod->name);
        $this->response->attributes("best_banking", $casinos['result']);
        $this->response->attributes("best_banking_total", $casinos['total']);
        $this->response->attributes("pop_banking", $banking->getPopularBankingCasinosCount($this->bankingMethod->id));
        
        
    }

    protected function getFilter()
    {
        return "banking_method";
    }
}
