<?php
require_once("application/models/dao/Casinos.php");

class CasinoBonusController extends Lucinda\MVC\STDOUT\Controller {
    public function run() {
        $object = new Casinos();
        $casinoID = $this->request->attributes()->get('validation_results')->get('casino');

        $this->response->attributes()->set("bonus", $object->getBonus($casinoID, (boolean) $this->request->parameters()->get("is_free")));
    }
}