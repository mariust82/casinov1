<?php
class SitemapWrapper extends ViewWrapper
{
    public function run() {
        // get parameters based on which sitemap will be constructed
        $pages = $this->response->getAttribute("pages");
        $lastModifiedDate = date("Y-m-d");
        $changeFrequency = "daily";
        $priority = $this->response->getAttribute("priority");

        // construct xml
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');
        foreach($pages as $page) {
            $child = $xml->addChild("url");
            $child->addChild("loc", $page);
            $child->addChild("lastmod", $lastModifiedDate);
            $child->addChild("changefreq", $changeFrequency);
            $child->addChild("priority", $priority);
        }
        echo $xml->asXML();
    }
}