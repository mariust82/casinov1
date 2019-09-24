<?php
require_once("application/models/dao/GameManufacturers.php");
require_once("CasinosListController.php");
/*
* Casinos list by software.
*
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/8735ce6f-75af-4583-8dca-6b3c775399c6/Software-page?fullscreen
* @pathParameter name string Name of software
*/
class CasinosBySoftwareController extends CasinosListController
{
    protected function getSelectedEntity()
    {
        $id = $this->request->attributes('validation_results')->get('name');
        $gm = new GameManufacturers();
        $name = $gm->getGameManufactures($id);
        return $name;
    }

    protected function getFilter()
    {
        return "software";
    }
}
