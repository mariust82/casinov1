<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/BankingSitemap.php");

class BankingMethodsController extends AbstractSitemapController
{
    private $dao;
    private $rows;
    
    protected function init() {
        $this->dao = new BankingSitemap();
        $this->rows = $this->dao->getBankingRows();
    }
    
    protected function getItems()
    {
        return array_keys($this->rows);
    }
    
    protected function getLastMod() {
        return array_values($this->rows);
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
