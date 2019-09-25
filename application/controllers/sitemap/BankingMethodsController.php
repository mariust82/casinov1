<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/BankingMethods.php");

class BankingMethodsController extends AbstractSitemapController
{
    protected function getItems()
    {
        $bm = new BankingMethods();
        return $bm->getAll();
    }

    protected function getUrlPattern()
    {
        return "banking/(item)";
    }

    protected function getPriority()
    {
        return "0.9";
    }
}
