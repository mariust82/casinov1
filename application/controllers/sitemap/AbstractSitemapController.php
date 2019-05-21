<?php
abstract class AbstractSitemapController extends Lucinda\MVC\STDOUT\Controller
{
    public function run() {
        $this->response->attributes()->set("pages", $this->getPages());
        $this->response->attributes()->set("priority", $this->getPriority());
    }

    private function getPages() {
        $urlPattern = $this->getUrlPattern();
        $protocol = $this->getProtocol();
        $items = $this->getItems();
        $pages = array();
        foreach($items as $name) {
            $pages[] = $protocol."://".$this->request->getServer()->getName()."/".strtolower(str_replace(" ", "-", str_replace("(item)", $name, $urlPattern)));
        }
        return $pages;
    }

    private function getProtocol() {
        $page = $this->request->getURI()->getPage();
        return (strpos($page, "sitemaps_ps/")===0?"https":"http");
    }

    abstract protected function getItems();

    abstract protected function getUrlPattern();

    abstract protected function getPriority();
}