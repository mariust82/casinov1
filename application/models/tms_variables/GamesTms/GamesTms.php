<?php
require_once 'GamesTmsInterface.php';
require_once 'application/models/GameSortCriteria.php';
require_once("application/models/orm/GamesByType.php");


class GamesTms implements GamesTmsInterface
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function getData($sortCriteria, $page = 1, $limit = 1)
    {
        return [];
    }
}
