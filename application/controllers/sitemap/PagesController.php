<?php
require_once("AbstractSitemapController.php");
require_once 'application/models/dao/Pages.php';

class PagesController extends AbstractSitemapController
{
    
    private $dao;
    
    protected function init() {
        $this->dao = new Pages();
    }

    protected function getItems()
    {
        return $this->dao->getAll();
    }

    protected function getUrlPattern()
    {
        return "(item)";
    }

    protected function getPriority()
    {
        return "0.6";
    }

}
