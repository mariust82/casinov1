<?php
require_once("application/models/CasinoFilter.php");
require_once("application/models/dao/CasinosList.php");

class GameManufacturerFilterController extends Lucinda\MVC\STDOUT\Controller
{
    public function run()
    {
        $parameters = $this->request->parameters();
        $filter = new CasinoFilter(
            array($parameters["filter"] => $parameters["entity"]),
            $this->request->attributes("country")
        );
        $object = new CasinosList($filter);
        $this->response->attributes("software", $object->getManufacturers());
    }
}