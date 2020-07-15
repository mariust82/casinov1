<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/Casinos.php");

class CountriesController extends AbstractSitemapController
{
    private $dao;
    
    protected function init() {
        $this->dao = new Casinos();
    }
    
    protected function getItems()
    {
        return $this->dao->getAllByCountries();
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
