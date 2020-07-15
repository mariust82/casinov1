<?php
require_once("AbstractSitemapController.php");
require_once 'application/models/dao/Casinos.php';

class CasinoLabelsController extends AbstractSitemapController
{
    private $dao;
    private $rows;
    
    protected function init() {
        $this->dao = new Casinos();
    }
    
    protected function getItems()
    {
        return $this->dao->getAllByLabels();
    }

    protected function getUrlPattern()
    {
        return "casinos/(item)";
    }

    protected function getPriority()
    {
        return "0.9";
    }
}
