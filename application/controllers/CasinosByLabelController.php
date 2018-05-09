<?php
require_once("application/models/dao/CasinoLabels.php");
require_once("CasinosListController.php");
/*
* Casinos list by label
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
* @pathParameter name string Name of casino label
*/
class CasinosByLabelController extends CasinosListController {
    protected function getSelectedEntity()
    {
        $parameter = $this->request->getValidator()->getPathParameter("name");
        if(!$parameter) {
            throw new PathNotFoundException();
        }
        $parameter = str_replace("-"," ", $parameter);
        $object = new CasinoLabels();
        $name = $object->validate($parameter);
        if(!$name) {
            throw new PathNotFoundException();
        }
        return $name;
    }

    protected function getFilter()
    {
        return new CasinoFilter(array("label"=>$this->response->getAttribute("selected_entity")), $this->request->getAttribute("country"));
    }

    protected function getSortCriteria() {
        if($this->response->getAttribute("selected_entity")=="New") {
            return CasinoSortCriteria::NEWEST;
        } elseif($this->response->getAttribute("selected_entity")=="Best") {
            return CasinoSortCriteria::TOP_RATED;
        } else {
            return CasinoSortCriteria::NONE;
        }
    }
}
