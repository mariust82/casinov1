<?php
require_once("AbstractSitemapController.php");
require_once("application/models/dao/GameTypes.php");

class GameTypesController extends AbstractSitemapController
{
    protected function getItems()
    {
        $bm = new GameTypes($this->request->attributes("is_mobile"));
        return $bm->getAll();
    }

    protected function getUrlPattern()
    {
        return "games/(item)";
    }

    protected function getPriority()
    {
        return "0.8";
    }
    protected function getLastMod()
    {

    }
}
