<?php
require_once("AbstractSitemapController.php");

class FeaturesController extends AbstractSitemapController {
    protected function getItems() {
        return ["Live Dealer", "Ecogra Casinos", "High Roller Casinos", "Jackpot Casinos"];
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