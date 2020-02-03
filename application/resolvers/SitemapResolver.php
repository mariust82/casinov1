<?php
class SitemapResolver extends \Lucinda\MVC\STDOUT\ViewResolver
{
    /**
     * {@inheritDoc}
     * @see \Lucinda\MVC\STDOUT\ViewResolver::getContent()
     */
    public function getContent()
    {
        // get parameters based on which sitemap will be constructed
        $pages = $this->response->attributes("pages");
        $lastModifiedDate = $this->response->attributes("lastMod");
        $changeFrequency = "daily";
        $priority = $this->response->attributes("priority");
        // construct xml
        ob_start();
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');
        $i = 0;
        foreach ($pages as $page) {
            $child = $xml->addChild("url");
            $child->addChild("loc", $page);
            if (is_array($lastModifiedDate)) {        
                $child->addChild("lastmod", $lastModifiedDate[$i]);
                $i++;
            } else {
                $child->addChild("lastmod", $lastModifiedDate);
            }
            $child->addChild("changefreq", $changeFrequency);
            $child->addChild("priority", $priority);
        }
        echo $xml->asXML();
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}
