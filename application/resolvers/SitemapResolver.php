<?php
class SitemapResolver extends \Lucinda\MVC\STDOUT\ViewResolver
{
    public function getContent()
    {
        // get parameters based on which sitemap will be constructed
        $pages = $this->response->attributes("sitemap");

        // construct xml
        ob_start();
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');
        $i = 0;
        foreach ($pages as $page) {
            $child = $xml->addChild("url");
            $child->addChild("loc", $page->loc);
            if (is_array($page->lastmod)) {
                $child->addChild("lastmod", $page->lastmod[$i]);
                $i++;
            } else {
                $child->addChild("lastmod", $page->lastmod);

            }
            $child->addChild("changefreq", $page->changefreq);
            $child->addChild("priority", $page->priority);
        }
        echo $xml->asXML();
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}
