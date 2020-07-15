<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/Games.php");

class GameTypesController extends AbstractSitemapController
{
    
    private $dao;
    private $rows;
    
    protected function init() {
        $this->dao = new Games();
        $this->rows = $this->dao->getAllByType();
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
        return "games/(item)";
    }

    protected function getPriority()
    {
        return "0.8";
    }
    
}
