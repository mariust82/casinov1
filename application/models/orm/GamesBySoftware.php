<?php
namespace CasinosLists;

require_once(dirname(__DIR__, 3)."/hlis/orm/src/dao/GameListDAO.php");
require_once("drivers/GameFields.php");
require_once("drivers/GameSort.php");
require_once("drivers/GameLineProcessor.php");
require_once("drivers/GamesBySoftwareQuery.php");
require_once(dirname(__DIR__, 3)."/vendor/lucinda/queries/src/Select.php");

class GamesBySoftware
{
    private $results = [];
    const LIMIT = 4;

    public function __construct($software,$limit=self::LIMIT,$page=0)
    {
        $fields = $this->getFields();
        $condition = $this->getCondition($software);
        $orderBy = $this->getOrderBy();
        $this->setResults($fields, $condition, $orderBy,$limit,$page);
    }

    private function getFields()
    {
        $gmf = new \Hlis\GameManufacturerFields();
        $gmf->setName();
        $fields = new \CasinosLists\GameFields();
        $fields->setName();
        $fields->setManufacturer($gmf);
        $fields->setTimesPlayed();
        return $fields;
    }

    private function getCondition($software)
    {
        $gmc = new \Hlis\GameManufacturerCondition();
        $gmc->setId($software);
        $condition = new \Hlis\GameCondition();
        $condition->setManufacturer($gmc);
        $condition->setId($software);
        return $condition;
    }

    private function getOrderBy()
    {
        $orderBy = new \Hlis\GameSort();
        $orderBy->setDateLaunched(FALSE);
        $orderBy->setId(false);
        return $orderBy;
    }

    private function setResults(\Hlis\GameFields $fields, \Hlis\GameCondition $condition, \Hlis\GameSort $orderBy,$limit=self::LIMIT,$page = 0)
    {
        $offset =$page == 0 ? 0 : $page == 1 ? 4 : ($page*$limit-$limit) + 4;
        $gld  = new \Hlis\GameListDAO(
                new \CasinosLists\GamesBySoftwareQuery($fields, $condition, $orderBy,$offset , $limit),
            new \CasinosLists\GameLineProcessor()
        );
        $this->results = $gld->getResults();
    }

    public function getResults()
    {
        return $this->results;
    }
}
