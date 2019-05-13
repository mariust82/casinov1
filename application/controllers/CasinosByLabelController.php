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
        $name = str_replace("-"," ", $parameter);

        $name =  $name == 'mobile' ? "Mobile" : $name ;
        return $name;
    }

    protected function getFilter()
    {
        if($this->request->getValidator()->getPathParameter("name")=="mobile") {
            return "compatibility";
        } else {
            return "label";
        }
    }

    protected function getSortCriteria() {

        switch($this->response->getAttribute("selected_entity")){
            case 'New':
                return CasinoSortCriteria::NEWEST;
            case 'Best':
                return CasinoSortCriteria::TOP_RATED;
            case 'Low Wagering':
                return CasinoSortCriteria::WAGERING;
            default:
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
            case 'best':
                $url = 'casinos/best';
                break;
            case 'stay away':
                $url = 'casinos/stay-away';
                break;
            case 'popular':
                $url = 'casinos/popular';
                break;
            case 'Mobile':
                $url = 'compatability/mobile';  // casinos/mobile
                break;
            case 'low wagering':
                $url = 'casinos/low-wagering';
                break;
        }
        $this->response->setAttribute("page_info", $object->getInfoByURL($url, $this->response->getAttribute("selected_entity"), $casinoNumber));
    }
}
