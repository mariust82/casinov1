<?php
require_once("application/models/dao/OperatingSystems.php");
require_once("application/models/dao/PlayVersions.php");
require_once("CasinosListController.php");

/*
* Casinos list by compatibility.
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
* @pathParameter name string Name of compatibility entity
*/
class CasinosByCompatibilityController extends CasinosListController {
    protected function getSelectedEntity()
    {
        $parameter = $this->request->getValidator()->getPathParameter("name");
        if(!$parameter) {
            throw new PathNotFoundException();
        }
        $parameter = str_replace("-"," ", $parameter);
        if($parameter=="iphone") return "iPhone";
        $object = new OperatingSystems();
        $name = $object->validate($parameter);
        if(!$name) {
            $object = new PlayVersions();
            $name = $object->validate($parameter);
            if(!$name) {
                throw new PathNotFoundException();
            }
        }
        return $name;
    }

    protected function getFilter()
    {
        return new CasinoFilter(array("compatibility"=>$this->response->getAttribute("selected_entity")), $this->request->getAttribute("country"));
    }
}
