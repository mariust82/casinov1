<?php
require_once("AbstractSitemapController.php");

class PagesController extends AbstractSitemapController {
    protected function getItems() {
        return ["Casinos","Softwares","Countries","Banking","Games"];
    }

    protected function getUrlPattern()
    {
        return "(item)";
    }

    protected function getPriority() {
        return "0.6";
    }
}