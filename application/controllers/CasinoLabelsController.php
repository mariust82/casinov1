<?php
require_once("application/models/dao/CasinoLabels.php");
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/CasinoFilter.php");
require_once("application/models/dao/CasinosList.php");
require_once("CasinosCounterController.php");
/*
* Casino labels list by number of casinos.
*
* @requestMethod GET
* @responseFormat HTML
* @source
*/
class CasinoLabelsController extends CasinosCounterController
{
    
    private $limit;

    protected function getCounter()
    {
        return new CasinoLabels();
    }
    
    protected function init() {
        $this->limit = 30;
        $results = $this->getCasinos();
        $this->response->attributes("total_casinos", $results["total"]);
        $this->response->attributes("casinos", $results["list"]);
        $this->response->attributes("page_type", 'label');
        $this->response->attributes("selected_entity", "all");
    }

    private function getCasinos()
    {
        $filter = new CasinoFilter(
            [],
            $this->request->attributes("country")
        );
        $object = new CasinosList($filter);
        $results = array();
        $results["total"] = $object->getTotal();
        $results["list"] = ($results["total"]>0 ? $object->getResults(CasinoSortCriteria::NONE, 1, $this->limit) : array());
        return $results;
    }
}
