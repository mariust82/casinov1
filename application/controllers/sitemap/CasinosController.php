<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/Casinos.php");

class CasinosController extends AbstractSitemapController
{
    protected function getItems()
    {
        $bm = new Casinos();
        return $bm->getAll();
    }

    protected function getUrlPattern()
    {
        return "reviews/(item)-review";
    }

    protected function getPriority()
    {
        return "0.7";
    }
}
