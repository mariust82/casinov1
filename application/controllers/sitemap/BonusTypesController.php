<?php
require_once("AbstractSitemapController.php");

class BonusTypesController extends AbstractSitemapController {
    protected function getItems() {
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
}