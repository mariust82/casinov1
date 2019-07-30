<?php
require_once("AbstractSitemapController.php");

class CasinoLabelsController extends AbstractSitemapController
{
    protected function getItems()
    {
        return ["Best", "New", "Popular", "Stay Away","Low Wagering","No Account Casinos"];
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