<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/Games.php");

class GamesController extends AbstractSitemapController
{
    
    private $rows;
    private $dao;

    protected function init() {
        $this->dao = new Games();
        $this->rows = $this->dao->getAllItems();
    }
    
    protected function getItems()
    { 
        $dao = new Games();
        return $dao->getAll();
    }

    protected function getUrlPattern()
    {
        return "play/(item)";
    }

    protected function getPriority()
    {
        return "0.6";
    }

}
