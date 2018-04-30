<?php
require_once("AbstractSitemapController.php");

class CompatibilityController extends AbstractSitemapController {
    protected function getItems() {
        return ["Mobile","Android","iPhone"];
    }

    protected function getUrlPattern()
    {
        return "compatability/(item)";
    }

    protected function getPriority() {
        return "0.9";
    }
}