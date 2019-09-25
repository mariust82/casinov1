<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/Games.php");

class GamesController extends AbstractSitemapController
{
    protected function getItems()
    {
        $bm = new Games();
        return $bm->getAll();
    }

    protected function getUrlPattern()
    {
        return "play/(item)";
    }

    protected function getPriority()
    {
        return "0.6";
    }
}
