<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/Countries.php");

class CountriesController extends AbstractSitemapController {
    protected function getItems()
    {
        $bm = new Countries();
        return $bm->getAll();
    }

    protected function getUrlPattern()
    {
        return "countries-list/(item)";
    }

    protected function getPriority()
    {
        return "0.9";
    }
}
