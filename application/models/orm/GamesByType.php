<?php
namespace CasinosLists;

require_once(dirname(__DIR__, 3)."/hlis/orm/src/dao/GameListDAO.php");
require_once(dirname(__DIR__, 3)."/hlis/orm/src/dao/GameListTotalDAO.php");
require_once("drivers/GameFields.php");
require_once("drivers/GameSort.php");
require_once("drivers/GameLineProcessor.php");
require_once(dirname(__DIR__, 3)."/vendor/lucinda/queries/src/Select.php");

class GamesByType
{
    const LIMIT = 24;
    private $results = ["total"=>0, "list"=>[]];

    public function __construct($gameType, $gameManufacturers=[], $isMobile, $sortBy, $page,$limit=  self::LIMIT)
    {
        $fields = $this->getFields();
        $condition = $this->getCondition($gameType, $gameManufacturers, $isMobile);
        $orderBy = $this->getOrderBy($sortBy);
        $this->setResults($fields, $condition, $orderBy, $page,$limit);
    }

    private function getFields()
    {
        $gmf = new \Hlis\GameManufacturerFields();
        $gmf->setName();

        $fields = new \CasinosLists\GameFields();
        $fields->setId();
        $fields->setName();
        $fields->setTimesPlayed();
        $fields->setManufacturer($gmf);
        return $fields;
    }

    private function getCondition($gameType, $gameManufacturers=[], $isMobile)
    {
        $gmc = new \Hlis\GameManufacturerCondition();
        $gmc->setIsOpen();
        if ($gameManufacturers) {
            $gmc->setId($gameManufacturers);
        }

        $gtc = new \Hlis\GameTypeCondition();
        $gtc->setId($gameType);

        $condition = new \Hlis\GameCondition();
        $condition->setIsOpen();
        if ($gameManufacturers) {
            $condition->setManufacturer($gmc);
        }
        $condition->setType($gtc);
        if ($isMobile) {
            $condition->setIsMobile();
        } else {
            $condition->setIsDesktop();
        }

        return $condition;
    }

    private function getOrderBy($sortBy)
    {
        $orderBy = new \CasinosLists\GameSort();
        switch ($sortBy) {
            case \GameSortCriteria::NEWEST:
                $orderBy->setDateLaunched(false);
                $orderBy->setId(false);
                break;
            case \GameSortCriteria::MOST_PLAYED:
                $orderBy->setTimesPlayed(false);
                $orderBy->setPriority(true);
                $orderBy->setId(false);
                break;
            default:
                $orderBy->setPriority(true);
                $orderBy->setId(false);
                break;
        }
        return $orderBy;
    }

    private function setResults(\Hlis\GameFields $fields, \Hlis\GameCondition $condition, \Hlis\GameSort $orderBy, $page,$limit=self::LIMIT)
    {
        $glt = new \Hlis\GameListTotalDAO(new \Hlis\GameListTotalQuery($condition));
        $this->results["total"] = $glt->getResults();
        if (!$this->results["total"]) {
            return;
        }
        $offset = $limit == 1 ? 0 : $page*$limit;
        $gld = new \Hlis\GameListDAO(
            new \Hlis\GameListRangeQuery($fields, $condition, $orderBy, $offset, $limit),
            new \CasinosLists\GameLineProcessor()
        );
        $this->results["list"] = $gld->getResults();
    }

    public function getResults()
    {
        return $this->results;
    }
}
