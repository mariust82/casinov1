<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/Casinos.php");

class CasinosController extends AbstractSitemapController
{
    private $dao;
    
    protected function init() {
        $this->dao = new Casinos();
    }

    protected function getItems()
    {
        return $this->dao->getAllByDate();
    }

    protected function getUrlPattern()
    {
        return "reviews/(item)-review";
    }

    protected function getPriority()
    {
        return "0.7";
    }
}
