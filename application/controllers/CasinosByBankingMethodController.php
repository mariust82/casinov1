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
class CasinosByBankingMethodController extends CasinosListController {
    protected function getSelectedEntity()
    {
        $parameter = $this->request->getValidator()->getPathParameter("name");
        if(!$parameter) {
            throw new PathNotFoundException();
        }
        $parameter = str_replace("-"," ", $parameter);
        $object = new BankingMethods();
        $name = $object->validate($parameter);
        if(!$name) {
            throw new PathNotFoundException();
        }
        return $name;
    }

    protected function getFilter()
    {
        return "banking_method";
    }
}
