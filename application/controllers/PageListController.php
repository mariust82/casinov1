<?php

require_once "PageController.php";

//require_once("hlis/tms/src/LucindaRequest.php");
//require_once 'hlis/tms/src/TextsManager.php';

use TMS\LucindaRequest;
use TMS\TextsManager;

abstract class PageListController extends PageController
{
    const LIMIT = 10;
    protected $filters = [];
    protected $results = [];
    protected $results_total = 0;

    const TMS_FOLDER = 'application/models/tms_variables';
    const TMS_SCHEMA = 'casinosl_admin_dev';

    function __construct(Lucinda\MVC\STDOUT\Application $objApplication, Lucinda\MVC\STDOUT\Request $objRequest, Lucinda\MVC\STDOUT\Response $objResponse)
    {
        parent::__construct($objApplication, $objRequest, $objResponse);
        $this->initPageHeadInfo();

//        $manager = new TextsManager(new LucindaRequest($this->request), self::TMS_FOLDER, self::TMS_SCHEMA);
//        $this->response->attributes('dynamic_vars', $manager->getTexts());
    }

    /**
     * Page info refers the the h1 and h2 tags at the top of most of the
     * pages.
     */
    function initPageHeadInfo()
    {
        $nfo = $this->pageInfo->getInfo();
        $this->response->attributes("hinfo", $nfo['hinfo']);

    }

    protected function getOffset()
    {
        $offset = 0;
        if (!empty($_GET['page'])) $offset = ((int)$_GET['page'] - 1) * $this::LIMIT;
        return $offset;
    }

    abstract protected function setItems();

    protected function setResponse()
    {
        $this->response->attributes("results", $this->results);
        $this->response->attributes("total", $this->results_total);
    }

    public function run()
    {
        $this->setItems();
        $this->setResponse();
        parent::run();
    }
}