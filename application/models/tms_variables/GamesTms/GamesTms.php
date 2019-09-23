<?php
require_once 'GamesTmsInterface.php';
require_once 'application/models/dao/GamesList.php';
//require_once 'application/models/GameFilter.php';
require_once 'application/models/GameSortCriteria.php';



class GamesTms implements GamesTmsInterface
{
    private $filter;

    public function __construct()
    {
//        $this->filter = $filter;
    }

    public function getData($sortCriteria, $page=1, $limit =1)
    {   
            $validationResults = $this->request->attributes("validation_results");
            $driver = new \CasinosLists\GamesByType(
            $validationResults->get("game_type"),
            $validationResults->get("software"),
            $this->request->attributes("is_mobile"),
            $sortCriteria?$sortCriteria:GameSortCriteria::NONE,
            $page+1,
            $limit
        );
        $result = $driver->getResults();
        return $result;
    }
}
