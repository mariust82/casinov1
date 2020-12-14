<?php
require_once("application/models/dao/CasinoInfo.php");
require_once("application/models/dao/Countries.php");
require_once("application/models/dao/Casinos.php");


class CasinoBonusPopUpController extends Lucinda\MVC\STDOUT\Controller
{
    public function run()
    {
        $casinos = new Casinos();
        $casinoID = $this->request->attributes("validation_results")->get("casino");
        $casinoInfo = new CasinoInfo($casinoID, $this->request->attributes("country")->id);
        $this->response->attributes("casino", $casinoInfo->getResult());
        $this->response->attributes("bonus", $casinos->getBonus($casinoID, (boolean) $this->request->parameters("is_free")));
        $this->response->attributes("bonus_type", $this->request->parameters("is_free"));
        $countries = new Countries();
        $this->response->attributes("country", $countries->getCountryDetails($this->request->attributes("country")->name)[0]);
    }
}




