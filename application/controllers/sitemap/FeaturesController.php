<?php
require_once("AbstractSitemapController.php");
require_once 'application/models/dao/Casinos.php';
class FeaturesController extends AbstractSitemapController
{
    protected function getItems()
    {
        $dao = new Casinos();
        return ["Ecogra Casinos"=>$dao->getLastModEcogra()];
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
