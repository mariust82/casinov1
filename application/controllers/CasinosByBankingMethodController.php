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
    protected function getSelectedEntity()
    {
        $parameter = $this->request->getValidator()->parameters("name");
        $name = str_replace("-", " ", $parameter);

        return $name;
    }
    
    private function getCasinos($filter, $sortBy, $limit)
    {
        $casinoFilter = new CasinoFilter($filter, $this->request->attributes("country"));
        $casinoFilter->setBankingMethod($this->getSelectedEntity());
        $casinoFilter->setPromoted(TRUE);
        $casinoFilter->setCountryAccepted(TRUE);
        $object = new CasinosList($casinoFilter);
        $results = $object->getResults($sortBy, 0, $limit);
        $total = $object->getTotal();
        $return = ['total'=>$total,'result'=>$results];
        return $return;
    }
    
    protected function init() {
        $casinos = $this->getCasinos([], CasinoSortCriteria::TOP_RATED, 5);
        $banking = new BankingMethods();
        $this->response->attributes("banking", $this->getSelectedEntity());
        $this->response->attributes("best_banking", $casinos['result']);
        $this->response->attributes("best_banking_total", $casinos['total']);
        $this->response->attributes("pop_banking", $banking->getPopularBankingCasinosCount($this->getSelectedEntity()));
        
    }

    protected function getFilter()
    {
        return "banking_method";
    }
}
