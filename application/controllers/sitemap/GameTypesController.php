<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/Games.php");

class GameTypesController extends AbstractSitemapController
{
    
    private $dao;
    
    protected function init() {
        $this->dao = new Games();
    }
    
    protected function getItems()
    {
        return $this->dao->getAllByType();
    }

    protected function getUrlPattern()
    {
        return "games/(item)";
    }

    protected function getPriority()
    {
        return "0.8";
    }
    
}
