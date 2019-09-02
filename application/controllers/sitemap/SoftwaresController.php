<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/GameManufacturers.php");

class SoftwaresController extends AbstractSitemapController
{
    protected function getItems()
    {
        $bm = new GameManufacturers();
        return $bm->getAll();
    }

    protected function getUrlPattern()
    {
        return "softwares/(item)";
    }

    protected function getPriority()
    {
        return "0.9";
    }
}
