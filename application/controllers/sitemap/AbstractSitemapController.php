<?php
abstract class AbstractSitemapController extends Controller
{
    const SITE_URL = "www.casinoslists.com";

    public function run() {
        $this->response->setAttribute("pages", $this->getPages());
        $this->response->setAttribute("priority", $this->getPriority());
        $this->response->setAttribute("date", date("Y-m-d"));
    }

    private function getPages() {
        $urlPattern = $this->getUrlPattern();
        $protocol = $this->getProtocol();
        $items = $this->getItems();
        $pages = array();
        foreach($items as $name) {
            $pages[] = $protocol."://".self::SITE_URL."/".strtolower(str_replace(" ", "-", str_replace("(item)", $name, $urlPattern)));
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