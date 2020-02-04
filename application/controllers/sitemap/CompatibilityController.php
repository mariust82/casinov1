<?php
require_once("AbstractSitemapController.php");
require_once 'application/models/dao/CompatibilitySitemap.php';
class CompatibilityController extends AbstractSitemapController
{
    protected function getItems()
    {
        return ["Mobile"];
    }

    protected function getUrlPattern()
    {
        return "casinos/(item)";
    }

    protected function getPriority()
    {
        return "0.9";
    }

    protected function getLastMod() {
        $dao = new CompatibilitySitemap($this->request->attributes("country")->id);
        return $dao->getLastMod();
    }

}
