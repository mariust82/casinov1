<?php
class SitemapRenderer implements \Lucinda\MVC\STDERR\ErrorRenderer
{
    public function render(\Lucinda\MVC\STDERR\Response $response)
    {
        ob_start();
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><error></error>');
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