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
        if(!$parameter) {
            throw new PathNotFoundException();
        }

        $parameter = str_replace("-"," ", $parameter);
        $object = new BonusTypes();
        $name = $object->validate($parameter);
        if(!$name) {
            throw new PathNotFoundException();
        }
        return $name;
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

        $this->response->setAttribute("page_info", $object->getInfoByURL($url, $this->response->getAttribute("selected_entity"), $this->response->getAttribute("total_casinos")));
    }

}
