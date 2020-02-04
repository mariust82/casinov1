<?php
require_once("AbstractSitemapController.php");
require_once 'application/models/dao/PagesSitemap.php';

class PagesController extends AbstractSitemapController
{
    
    private $dao;
    private $rows;
    protected function init() {
        $this->dao = new PagesSitemap($this->request->attributes("country")->id);
        $this->rows = $this->dao->getPagesRows();
    }

    protected function getItems()
    {
        return array_keys($this->rows);
    }

    protected function getUrlPattern()
    {
        return "(item)";
    }

    protected function getPriority()
    {
        return "0.6";
    }

    protected function getLastMod() {
        return array_values($this->rows);
    }

}
