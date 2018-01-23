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
            case "high roller casinos":
                return "High Roller Casinos";
                break;
            case "jackpot casinos":
                return "Jackpot Casinos";
                break;
            default:
                throw new PathNotFoundException();
                break;
        }
    }

    protected function getFilter()
    {
        return new CasinoFilter(array("feature"=>$this->response->getAttribute("selected_entity")), $this->request->getAttribute("country"));
    }
}
