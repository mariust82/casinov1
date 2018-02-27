<?php
require_once("AbstractSitemapController.php");

class CompatibilityController extends AbstractSitemapController {
    protected function getItems() {
        return ["Flash","Mobile","Android","iPhone","Linux","Mac"];
    }

    protected function getUrlPattern()
    {
        return "compatability/(item)";
    }

    protected function getPriority() {
        return "0.9";
    }
}