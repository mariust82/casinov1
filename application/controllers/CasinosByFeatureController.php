<?php
require_once("application/models/dao/PlayVersions.php");
require_once("application/models/dao/Certifications.php");
require_once("application/models/dao/Casinos.php");
require_once("CasinosListController.php");

/*
* Casinos list by play versions.
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
* @pathParameter version string Name of play version
*/
class CasinosByFeatureController extends CasinosListController {
    protected function getSelectedEntity()
    {
        $parameter = $this->request->getValidator()->getPathParameter("name");
        if(!$parameter) {
            throw new PathNotFoundException();
        }
        $parameter = strtolower(str_replace("-"," ", $parameter));
        switch($parameter) {
            case "live dealer":
                return "Live Dealer";
                break;
            case "ecogra casinos":
                return "eCOGRA Casinos";
                break;
            default:
                throw new PathNotFoundException();
                break;
        }
    }

    protected function getFilter()
    {
        return "feature";
    }

    protected function pageInfo(){

        $selectedEntity = $this->getSelectedEntity();

        // get page info
        $url = $this->request->getValidator()->getPage();
        $object = new PageInfoDAO();

        switch ($selectedEntity){
            case 'Live Dealer':
                $url = 'features/live-dealer';
            break;
            case 'eCOGRA Casinos':
                $url = 'features/ecogra-casinos';
            break;
        }

        $this->response->setAttribute("page_info", $object->getInfoByURL($url, $this->response->getAttribute("selected_entity"), $this->response->getAttribute("total_casinos")));
    }
}
