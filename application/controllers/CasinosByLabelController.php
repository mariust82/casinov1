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
        $country =  $this->request->getAttribute("country");
        $parameter = str_replace("-"," ", $parameter);
        $object = new CasinoLabels($country);
        $name = $object->validate($parameter);
        if(!$name) {
            throw new PathNotFoundException();
        }
        return $name;
    }

    protected function getFilter()
    {
        return "label";
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

    protected function pageInfo(){

        // get page info
        $url = $this->request->getValidator()->getPage();
        $object = new PageInfoDAO();
        $selectedEntity = $this->getSelectedEntity();
        $casinoNumber =  !empty($this->response->getAttribute("total_casinos")) ? $this->response->getAttribute("total_casinos") : '';

        switch ($selectedEntity){
            case 'Best':
                $url = 'casinos/best';
                break;
            case 'Stay away':
                $url = 'casinos/stay-away';
                break;
            case 'Popular':
                $url = 'casinos/popular';
                break;
        }
        $this->response->setAttribute("page_info", $object->getInfoByURL($url, $this->response->getAttribute("selected_entity"), $casinoNumber));
    }
}
