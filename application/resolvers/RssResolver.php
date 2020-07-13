<?php
class RssResolver extends \Lucinda\MVC\STDOUT\ViewResolver
{
    public function getContent()
    {
        // get parameters based on which sitemap will be constructed
        $feed = $this->response->attributes("feed");

        // construct xml
        ob_start();
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><rss xmlns:media="http://search.yahoo.com/mrss/" version="2.0"
        xmlns:atom="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/"
        xmlns:custom="http://search.yahoo.com/mrss/" xmlns:slash="http://purl.org/rss/1.0/modules/slash/"></rss>');
        $xml->addChild("title", $feed->title);
        $xml->addChild("description", $feed->description);
        $xml->addChild("link", $feed->link);
        foreach ($feed->nodes as $node) {
            $child = $xml->addChild("item");
            $child->addChild("title", $node->title);
            $child->addChild("url", $node->url);
            $child->addChild("description", "<![CDATA[\n".$node->description."\n]]>");
            $child->addChild("content", $node->content);
            $child->addChild("author", $node->author);
            $child->addChild("slash:comments", $node->comments);
            $child->addChild("pubDate", $node->pubDate);
            $child->addChild("guid", $node->guid);
        }
        echo $xml->asXML();
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}