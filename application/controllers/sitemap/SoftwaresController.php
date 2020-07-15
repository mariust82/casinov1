<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/Games.php");

class SoftwaresController extends AbstractSitemapController
{
    private $dao;
    private $rows;
    
    protected function init() {
        $this->dao = new Games();
    }
    
    protected function getItems()
    {
        return $this->dao->getAllBySoftware();
    }

    protected function getUrlPattern()
    {
        return "softwares/(item)";
    }

    protected function getPriority()
    {
        return "0.9";
    }
}
