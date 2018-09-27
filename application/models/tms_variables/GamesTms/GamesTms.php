<?php
require_once 'GamesTmsInterface.php';
require_once 'application/models/dao/GamesList.php';
require_once 'application/models/GameFilter.php';
require_once 'application/models/GameSortCriteria.php';



class  GamesTms implements GamesTmsInterface {

    private $filter;

    public  function __construct(GameFilter $filter)
    {
        $this->filter = $filter;
    }

    public function getData($sortCriteria, $page=1, $limit =1 )
    {
        $object = new GamesList($this->filter);
        $result =  $object->getResults($sortCriteria, $page, $limit);
        return $result;
    }
}