<?php
namespace CasinosLists;

require_once(dirname(__DIR__,3)."/hlis/orm/src/dao/GameListDAO.php");
require_once("drivers/GameFields.php");
require_once("drivers/GameSort.php");
require_once("drivers/GameLineProcessor.php");
require_once(dirname(__DIR__,3)."/vendor/lucinda/queries/src/Select.php");

class GamesFeaturedList
{
    private $results = [];
    const LIMIT = 8;

    public function __construct($isMobile) {
        $fields = $this->getFields();
        $condition = $this->getCondition($isMobile);
        $orderBy = $this->getOrderBy();
        $this->setResults($fields, $condition, $orderBy);
    }

    private function getFields() {
        $gmf = new \Hlis\GameManufacturerFields();
        $gmf->setName();

        $fields = new \CasinosLists\GameFields();
        $fields->setId();
        $fields->setName();
        $fields->setTimesPlayed();
        $fields->setManufacturer($gmf);

        return $fields;
    }

    private function getCondition($isMobile) {
        $gmc = new \Hlis\GameManufacturerCondition();
        $gmc->setIsOpen();

        $condition = new \Hlis\GameCondition();
        $condition->setIsOpen();
        $condition->setManufacturer($gmc);
        if($isMobile) $condition->setIsMobile();
        else $condition->setIsDesktop();

        return $condition;
    }

    private function getOrderBy() {
        $orderBy = new \Hlis\GameSort();
        $orderBy->setDateLaunched(false);
        $orderBy->setId(false);
        return $orderBy;
    }

    private function setResults(\Hlis\GameFields $fields, \Hlis\GameCondition $condition, \Hlis\GameSort $orderBy) {
        $gld  = new \Hlis\GameListDAO(
            new \Hlis\GameListRangeQuery($fields, $condition, $orderBy, 0, self::LIMIT),
            new \CasinosLists\GameLineProcessor()
        );
        $this->results = $gld->getResults();
    }

    public function getResults() {
        return $this->results;
    }
}