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
class CasinosByFeatureController extends CasinosListController
{
    protected function getSelectedEntity()
    {
        $page = $this->request->attributes('validation_results')->get('name');
        $this->setLimitExceptions($page);
        return $page;
    }

    private function setLimitExceptions($pageType)
    {
        if ($pageType == 'Live Dealer') {
            $this->limit = 30;
        }
    }

    protected function getFilter()
    {
        return "feature";
    }

    protected function pageInfo()
    {
        $selectedEntity = $this->getSelectedEntity();

        // get page info
        $url = $this->request->getValidator()->getPage();
        $object = new PageInfoDAO();

        switch ($selectedEntity) {
            case 'Live Dealer':
                $url = 'features/live-dealer';
            break;
            case 'eCOGRA Casinos':
                $url = 'features/ecogra-casinos';
            break;
        }

        $this->response->attributes("page_info", $object->getInfoByURL($url, $this->response->attributes("selected_entity"), $this->response->attributes("total_casinos")));
    }
}
