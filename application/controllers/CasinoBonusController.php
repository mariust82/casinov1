<?php
require_once("application/models/dao/Casinos.php");

class CasinoBonusController extends Controller {
    public function run() {
        $object = new Casinos();
        $casinoID = $this->request->getAttribute('validation_results')->get('casino');

        $this->response->setAttribute("bonus", $object->getBonus($casinoID, (boolean) $this->request->getParameter("is_free")));
    }
}