<?php
require_once("AbstractSitemapController.php");

class CasinoLabelsController extends AbstractSitemapController
{
    protected function getItems()
    {
        return ["Best", "Safe", "New", "Recommended", "Popular", "Blacklisted"];
    }

    protected function getUrlPattern()
    {
        return "casinos/(item)";
    }

    protected function getPriority()
    {
        return "0.9";
    }
}