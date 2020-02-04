<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/Games.php");

class GamesController extends AbstractSitemapController
{
    
    private $dao;
    
    protected function init() {
        $this->dao = new Games();
    }
    
    protected function getItems()
    {
        return $this->dao->getAll();
    }

    protected function getUrlPattern()
    {
        return "play/(item)";
    }

    protected function getPriority()
    {
        return "0.6";
    }

    protected function getLastMod() {
        return $this->dao->getGamesLastMod();
    }

}
