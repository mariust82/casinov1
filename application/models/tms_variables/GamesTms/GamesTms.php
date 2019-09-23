<?php
require_once 'GamesTmsInterface.php';
//require_once 'application/models/dao/GamesList.php';
//require_once 'application/models/GameFilter.php';
require_once 'application/models/GameSortCriteria.php';
require_once("application/models/orm/GamesByType.php");



class GamesTms implements GamesTmsInterface
{
    private $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function getData($sortCriteria, $page=1, $limit =1)
    {   
            $driver = new \CasinosLists\GamesByType(
            $this->request->attributes("validation_results")->get("type"),
            [],
            $this->request->attributes("is_mobile"),
            $sortCriteria?$sortCriteria:GameSortCriteria::NONE,
            $page,
            $limit
        );
        $result = $driver->getResults();
        return $result;
    }
}
