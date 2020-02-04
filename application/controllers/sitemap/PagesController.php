<?php
require_once("AbstractSitemapController.php");
require_once 'application/models/dao/PagesSitemap.php';

class PagesController extends AbstractSitemapController
{
    protected function getItems()
    {
        return ["Casinos","Softwares","Countries","Banking","Games"];
    }

    protected function getUrlPattern()
    {
        return "(item)";
    }

    protected function getPriority()
    {
        return "0.6";
    }

    protected function getLastMod() {
        $dao = new PagesSitemap($this->request->attributes("country")->id);
        return $dao->getPagesRows();
    }

}
