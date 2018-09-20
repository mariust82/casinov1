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
        if ($parameter === 'no-deposit-bonus') {
            return true;
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
        if ($this->getSelectedEntity() === true)
            return 'free_bonus';
        // send it as filter
        return "bonus_type";
    }


}
