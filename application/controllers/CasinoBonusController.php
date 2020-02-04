<?php
require_once("application/models/dao/Casinos.php");

class CasinoBonusController extends Lucinda\MVC\STDOUT\Controller
{
    public function run()
    {
        $object = new Casinos();
        $casinoID = $this->request->attributes('validation_results')->get('casino');
        $this->response->attributes("is_mobile", $this->request->attributes("is_mobile"));
        $this->response->attributes("name", $this->request->parameters("casino"));
        $this->response->attributes("bonus", $object->getBonus($casinoID, (boolean) $this->request->parameters("is_free")));
    }
}
