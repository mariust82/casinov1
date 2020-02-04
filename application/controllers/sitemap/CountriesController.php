<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/CountriesSitemap.php");

class CountriesController extends AbstractSitemapController
{
    private $dao;
    private $rows;
    
    protected function init() {
        $this->dao = new CountriesSitemap($this->request->attributes("country")->id);
        $this->rows = $this->dao->getCountriesRows();
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
        return "countries-list/(item)";
    }

    protected function getPriority()
    {
        return "0.9";
    }
}
