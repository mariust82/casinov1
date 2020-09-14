<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/Games.php");

class GamesController extends AbstractSitemapController
{
    
    private $rows;
    
    protected function init() {
        $dao = new Games();
        $this->rows = $dao->getAllItems();
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
