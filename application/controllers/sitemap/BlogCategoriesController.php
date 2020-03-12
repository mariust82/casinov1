<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/sitemap/BlogSitemap.php");

class BlogCategoriesController extends AbstractSitemapController {
    private $dao;
    private $rows;
    
    protected function init() {
        $this->dao = new BlogSitemap();
        
    }
    
    protected function getItems()
    {
       $this->rows = $this->dao->getBlogCategories();
    }
    
    protected function getLastMod() {   
        return $this->dao->getBlogCategoriesLastMod();
    }

    protected function getUrlPattern()
    {
        return "(category)/(name)";
    }

    protected function getPriority()
    {
        return "0.8";
    }
}
