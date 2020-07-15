<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/BankingMethods.php");

class BankingMethodsController extends AbstractSitemapController
{
    private $dao;
    
    protected function init() {
        $this->dao = new BankingMethods();
    }
    
    protected function getItems()
    {
        return $this->dao->getAllByDate();
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
