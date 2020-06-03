<?php
require_once 'application/models/entities/SitemapNode.php';

abstract class AbstractSitemapController extends Lucinda\MVC\STDOUT\Controller
{
    public function run()
    {
        $this->init();
        $this->response->attributes("sitemap", $this->getPages());
    }
    
    protected function init() {}

    private function getPages()
    {
        $sitemap = new SitemapNode();
        $urlPattern = $this->getUrlPattern();
        $protocol = $this->getProtocol();
        $items = $this->getItems();

        $output = array();
        foreach ($items as $name) {
            if(strtolower($name) == "slots") {
                $sitemap->loc = $protocol . "://" . $this->request->getServer()->getName() . "/" . strtolower(str_replace(" ", "-", str_replace("(item)", htmlspecialchars('classic-'.$name), $urlPattern)));
            }else
                $sitemap->loc = $protocol."://".$this->request->getServer()->getName()."/".strtolower(str_replace(" ", "-", str_replace("(item)", htmlspecialchars($name), $urlPattern)));
            $sitemap->changefreq = 'daily' ;
            $sitemap->priority = $this->getPriority();
            $sitemap->lastmod =  $this->getLastMod();
            $output[] = $sitemap;
        }

        return $output;
    }

    private function getProtocol()
    {
        $page = $this->request->getURI()->getPage();
        return (strpos($page, "sitemaps_ps/")===0?"https":"http");
    }
    
    abstract protected function getLastMod();

    abstract protected function getItems();

    abstract protected function getUrlPattern();

    abstract protected function getPriority();
}
