<?php
require_once("AbstractSitemapController.php");
require_once 'application/models/dao/Casinos.php';

class CompatibilityController extends AbstractSitemapController
{
    protected function getItems()
    {
        $dao = new Casinos();
        return ["Mobile"=>$dao->getLastModMobile()];
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
