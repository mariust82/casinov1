<?php
require_once("AbstractSitemapController.php");
require_once 'application/models/dao/sitemap/BonusTypesSitemap.php';

class BonusTypesController extends AbstractSitemapController
{
    protected function getItems()
    {
        return ["No Deposit Bonus"];
    }

    protected function getUrlPattern()
    {
        return "bonus-list/(item)";
    }

    protected function getPriority()
    {
        return "0.9";
    }

    protected function getLastMod() {
        $dao = new BonusTypesSitemap($this->request->attributes("country")->id);
        return $dao->getLastMod();
    }

}
