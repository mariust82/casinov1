<?php
require_once("AbstractSitemapController.php");
require_once 'application/models/dao/sitemap/CasinosSitemap.php';

class CasinoLabelsController extends AbstractSitemapController
{
    private $dao;
    private $rows;
    
    protected function init() {
        $this->dao = new CasinosSitemap($this->request->attributes("country")->id);
        $this->rows = $this->dao->getCasinosByLabelLastMod();
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
        return "casinos/(item)";
    }

    protected function getPriority()
    {
        return "0.9";
    }
}
