<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/GameManufacturersSitemap.php");

class SoftwaresController extends AbstractSitemapController
{
    private $dao;
    private $rows;
    
    protected function init() {
        $this->dao = new GameManufacturersSitemap($this->request->attributes("country")->id);
        $this->rows = $this->dao->getGameManufacturersRows();
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
        return "softwares/(item)";
    }

    protected function getPriority()
    {
        return "0.9";
    }
}
