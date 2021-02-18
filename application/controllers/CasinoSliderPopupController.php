<?php
require_once("application/models/dao/CasinosList.php");
require_once("application/models/CasinoFilter.php");

class CasinoSliderPopupController extends Lucinda\MVC\STDOUT\Controller
{

    public function run()
    {
        $id = $this->request->parameters("id");
        $dao = new CasinosList(new CasinoFilter([],$this->request->attributes("country")));
        $this->response->attributes("bonus",$dao->getBonusCasinosPopup($id));
    }
}