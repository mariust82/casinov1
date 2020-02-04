<?php
require_once("AbstractSitemapController.php");
require_once 'application/models/dao/sitemap/FeaturesSitemap.php';
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

    protected function getLastMod() {
        $dao = new FeaturesSitemap($this->request->attributes("country")->id);
        return $dao->getLastMod();
    }

}
