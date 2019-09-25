<?php
require_once("AbstractSitemapController.php");

class FeaturesController extends AbstractSitemapController
{
    protected function getItems()
    {
        return ["Ecogra Casinos"];
    }

    protected function getUrlPattern()
    {
        return "features/(item)";
    }

    protected function getPriority()
    {
        return "0.9";
    }
}
