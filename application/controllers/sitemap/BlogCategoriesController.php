<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/Articles.php");

class BlogCategoriesController extends AbstractSitemapController {
    private $dao;
    
    protected function init() {
        $this->dao = new Articles("");
    }
    
    protected function getItems()
    {
        return $this->dao->getAllByDate();
    }

    protected function getUrlPattern()
    {
        return "(item)";
    }

    protected function getPriority()
    {
        return "0.8";
    }
}
