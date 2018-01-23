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

        // send it as filter
        return new CasinoFilter(array("bonus_type"=>$this->response->getAttribute("selected_entity")), $this->request->getAttribute("country"));
    }
}
