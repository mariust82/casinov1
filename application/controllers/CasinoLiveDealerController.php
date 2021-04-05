<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 22-Jul-19
 * Time: 1:00 PM
 */

require_once("application/models/dao/PlayVersions.php");
require_once("application/models/dao/Certifications.php");
require_once("application/models/dao/Casinos.php");
require_once("CasinosListController.php");

class CasinoLiveDealerController extends CasinosListController
{
    protected $limit = 50;

    protected function getSelectedEntity()
    {
        return $this->request->attributes('validation_results')->get('TYPE');
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

        $page =  $object->getInfoByURL($url, $this->response->attributes("selected_entity"));
        $this->pageInfoSpecifications($page);
        $this->response->attributes("page_info", $page);
    }

    protected function pageInfoSpecifications(&$page)
    {
        $page->head_title = str_replace('(TYPE)', $this->response->attributes("selected_entity"), $page->head_title);
        $page->head_description = str_replace('(TYPE)', $this->response->attributes("selected_entity"), $page->head_description);
        $page->body_title = str_replace('(TYPE)', $this->response->attributes("selected_entity"), $page->body_title);
    }
}
