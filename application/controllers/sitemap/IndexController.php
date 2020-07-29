<?php
require_once("AbstractSitemapController.php");

class IndexController extends AbstractSitemapController
{
    protected function getItems()
    {
        return [""=>date("Y-m-d")];
    }

    protected function getUrlPattern()
    {
        return "(item)";
    }

    protected function getPriority()
    {
        return "1.0";
    }
}
