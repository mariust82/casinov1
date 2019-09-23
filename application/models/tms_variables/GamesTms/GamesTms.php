<?php
require_once 'GamesTmsInterface.php';
require_once 'application/models/dao/GamesList.php';
//require_once 'application/models/GameFilter.php';
require_once 'application/models/GameSortCriteria.php';



class GamesTms implements GamesTmsInterface
{
    private $filter;
    public function __construct($validationResults)
    {
        $this->filter = $validationResults;
    }

    public function getData($sortCriteria, $page=1, $limit =1)
    {   
            $driver = new \CasinosLists\GamesByType(
            $this->filter->attributes("validation_results")->get("type"),
            [],
            $this->filter->attributes("is_mobile"),
            $sortCriteria?$sortCriteria:GameSortCriteria::NONE,
            $page+1,
            $limit
        );
        $result = $driver->getResults();
        return $result;
    }
}
