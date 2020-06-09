<?php
{
    public function render(\Lucinda\MVC\STDERR\Response $response)
{
    ob_start();
    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><rss xmlns:media="http://search.yahoo.com/mrss/" version="2.0"
        xmlns:atom="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/"
        xmlns:custom="http://search.yahoo.com/mrss/" xmlns:slash="http://purl.org/rss/1.0/modules/slash/"></rss>');
    $attributes = $response->attributes();
    foreach ($attributes as $name=>$value) {
        $xml->addChild($name, $value);
    }
    echo $xml->asXML();
    $output = ob_get_contents();
    ob_end_clean();
    $response->getOutputStream()->write($output);
}
}