<?php
require_once("application/models/dao/GameManufacturers.php");
require_once("CasinosListController.php");
require_once("application/models/orm/GamesBySoftware.php");
/*
* Casinos list by software.
*
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/8735ce6f-75af-4583-8dca-6b3c775399c6/Software-page?fullscreen
* @pathParameter name string Name of software
*/
class CasinosBySoftwareController extends CasinosListController
{
    protected function getSelectedEntity()
    {
        $id = $this->request->attributes('validation_results')->get('name');
        $gm = new GameManufacturers();
        $name = $gm->getGameManufactures($id);
        return $name;
    }
    
    private function getCasinos($filter, $sortBy, $limit, $label='')
    {
        $casinoFilter = new CasinoFilter($filter, $this->request->attributes("country"));
        if (!empty($label)) {
            $casinoFilter->setCasinoLabel($label);
            if ($label == 'Best') {
                $casinoFilter->setPromoted(TRUE);
            }
        }
        $casinoFilter->setSoftware($this->getSelectedEntity());
        $object = new CasinosList($casinoFilter);
        $results = $object->getResults($sortBy, 0, $limit);
        $total = $object->getTotal();
        $return = ['total'=>$total,'result'=>$results];
        return $return;
    }
    
    protected function init() {
        $id = $this->request->attributes('validation_results')->get('name');
        $name = $this->getSelectedEntity();
        $gfl = new \CasinosLists\GamesBySoftware($id);
        $results = $gfl->getResults();
        $this->response->attributes("recommended_games", $results['list']);
        $this->response->attributes("total_games", $results["total"]);
        $new_casinos = $this->getCasinos([], CasinoSortCriteria::NEWEST, 5,'New');
        $best_casinos = $this->getCasinos([], CasinoSortCriteria::TOP_RATED, 5,'Best');
        $ndp_casinos = $this->getCasinos(array("bonus_type"=>"no deposit bonus"), CasinoSortCriteria::DATE_ADDED, 5);
        $country_casinos = $this->getCasinos(array("country_accepted"=>1), CasinoSortCriteria::NONE, 5);
        $this->response->attributes("new_casinos", $new_casinos['result']);
        $this->response->attributes("new_casinos_total", $new_casinos['total']);
        $this->response->attributes("best_casinos", $best_casinos['result']);
        $this->response->attributes("best_casinos_total", $best_casinos['total']);
        $this->response->attributes("no_deposit_casinos", $ndp_casinos['result']);
        $this->response->attributes("no_deposit_casinos_total", $ndp_casinos['total']);
        $this->response->attributes("country_casinos", $country_casinos['result']);
        $this->response->attributes("country_casinos_total", $country_casinos['total']);
        $this->response->attributes("software_id", $id);
        $this->response->attributes("software", $name);
        $filter = new CasinoFilter(
            array($this->response->attributes("filter") => $this->response->attributes("selected_entity")),
            $this->request->attributes("country")
        );
        $dao = new CasinosList($filter);
    }

    protected function getFilter()
    {
        return "software";
    }
}
