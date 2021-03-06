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
class CasinosByLabelController extends CasinosListController
{
    protected $limit = 50;

    protected function init()
    {
        $this->response->attributes("limit_per_page", $this->limit);
    }

    protected function getSelectedEntity()
    {
        $parameter = $this->request->getValidator()->parameters("name");
        $name = str_replace("-", " ", $parameter);

        $name =  $name == 'mobile' ? "Mobile" : $name ;
        return $name;
    }

    protected function getFilter()
    {
        if ($this->request->getValidator()->parameters("name")=="mobile") {
            return "compatibility";
        } else {
            return "label";
        }
    }

    protected function getSortCriteria()
    {
        switch ($this->response->attributes("selected_entity")) {
            case 'New':
                return CasinoSortCriteria::NEWEST;
             case 'Fast Payout':
                return CasinoSortCriteria::FAST_PAYOUT;
            case 'Best':
                return CasinoSortCriteria::TOP_RATED;
            case 'Low Wagering':
                return CasinoSortCriteria::WAGERING;
            case 'No Account Casinos':
                return CasinoSortCriteria::NO_ACCOUNT;
            default:
                if ($this->response->attributes("filter") == 'country') {
                    return CasinoSortCriteria::POPULARITY;
                } else {
                    return CasinoSortCriteria::NONE;
                }
        }
    }

    protected function pageInfo()
    {

        // get page info
        $url = $this->request->getValidator()->getPage();
        $object = new PageInfoDAO();
        $selectedEntity = $this->getSelectedEntity();
        $casinoNumber =  !empty($this->response->attributes("total_casinos")) ? $this->response->attributes("total_casinos") : '';
        switch ($selectedEntity) {
            case 'Mobile':
                $url = 'compatability/mobile';  // casinos/mobile
                break;
            default:
                $url = 'casinos/'.str_replace(" ", "-", $selectedEntity);
        }
        $this->response->attributes("page_info", $object->getInfoByURL($url, $this->response->attributes("selected_entity"), $casinoNumber));
    }
}
