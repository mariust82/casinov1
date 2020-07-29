<?php
require_once("AbstractSitemapController.php");
require_once 'application/models/dao/Casinos.php';

class BonusTypesController extends AbstractSitemapController
{
    protected function getItems()
    {
        $dao = new Casinos();
        return ["No Deposit Bonus"=>$dao->getLastModNDB()];
    }

    protected function getUrlPattern()
    {
        return "bonus-list/(item)";
    }

    protected function getPriority()
    {
        return "0.9";
    }

    protected function getLastMod() {
    }

}
