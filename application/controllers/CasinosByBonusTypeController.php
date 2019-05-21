<?php
require_once("application/models/dao/BonusTypes.php");
require_once("CasinosListController.php");
/*
* Casinos list by bonus type
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
* @pathParameter type string Name of bonus type
*/
class CasinosByBonusTypeController extends CasinosListController {
    protected function getSelectedEntity()
    {
        $parameter = $this->request->getValidator()->getPathParameter("name");
        $parameter = str_replace("-"," ", $parameter);
        return ucwords($parameter);
    }



    protected function getFilter()
    {

        if ($this->getSelectedEntity() === 'No Deposit Bonus')
            return 'free_bonus';
        // send it as filter
        return "bonus_type";
    }

    protected function pageInfo(){

        // get page info
        $url = $this->request->getValidator()->getPage();
        $object = new PageInfoDAO();
        if ($this->getSelectedEntity() === 'No Deposit Bonus'){
            $url = str_replace('(name)', 'no-deposit-bonus', $url);
        }

        $this->response->attributes()->set("page_info", $object->getInfoByURL($url, $this->response->attributes()->get("selected_entity"), $this->response->attributes()->get("total_casinos")));
    }

    protected function getSortCriteria() {
        return CasinoSortCriteria::NEWEST;
    }

}
