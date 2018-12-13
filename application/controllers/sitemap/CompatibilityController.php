<?php
require_once("AbstractSitemapController.php");

class CompatibilityController extends AbstractSitemapController {
    protected function getItems() {
        return ["Mobile"];
    }

    protected function getUrlPattern()
    {
        return "casinos/(item)";
    }

    protected function getPriority() {
        return "0.9";
    }
}