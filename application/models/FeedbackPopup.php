<?php

require_once 'application/models/dao/Casinos.php';


class FeedbackPopup
{

    public function checkAndSaveVisit($ip, $casinoID)
    {
        $casino = new Casinos();
        if(empty($casino->checkDailyFeedback($ip))) {
            if(empty($casino->checkCasinoVisit($ip, $casinoID))) {
                $casino->saveCasinoVisit($ip, $casinoID);
                return 1;
             }
        }
        return 0;
    }

}