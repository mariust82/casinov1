<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/sitemap/BlogSitemap.php");

class BlogCategoriesController extends AbstractSitemapController {
    private $dao;
    private $rows;
    
    protected function init() {
        $this->dao = new BlogSitemap();
        $this->rows = $this->dao->getBlogCategories();
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
        return "(item)";
    }

    protected function getPriority()
    {
        return "0.8";
    }
}