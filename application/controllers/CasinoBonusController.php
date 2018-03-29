<?php
require_once("application/models/dao/Casinos.php");

class CasinoBonusController extends Controller {
    public function run() {
        $object = new Casinos();
        $casinoID = $object->getId($this->request->getParameter("casino"));
        if(!$casinoID) throw new PathNotFoundException();
        $this->response->setAttribute("bonus", $object->getBonus($casinoID, (boolean) $this->request->getParameter("is_free")));
    }
}