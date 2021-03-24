<?php

require_once 'application/models/FeedbackPopup.php';
require_once 'application/models/dao/Casinos.php';


class CasinoFeedbackPopupController extends Lucinda\MVC\STDOUT\Controller
{
    public function run()
    {
        $feedbackPopup = new FeedbackPopup();
        $savedVisit = $feedbackPopup->checkAndSaveVisit($this->request->attributes('ip'), $this->request->parameters('id'));
        $casino = new Casinos();
        $this->response->attributes("casinoID", $this->request->parameters('id'));
        $this->response->attributes("casinoName", $casino->getName($this->request->parameters('id')));
        $this->response->attributes("showPopup", $savedVisit);
    }
}