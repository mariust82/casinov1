<?php
namespace CasinosLists;

require_once(dirname(__DIR__, 3)."/hlis/orm/src/dao/GameListDAO.php");
require_once("drivers/GameFields.php");
require_once("drivers/GameSort.php");
require_once("drivers/GameLineProcessor.php");
require_once("drivers/GamesRecommendedQuery.php");
require_once(dirname(__DIR__, 3)."/vendor/lucinda/queries/src/Select.php");

class GamesRecommended
{
    private $results = [];
    const LIMIT = 8;

    public function __construct($excludedGameID, $gameType, $isMobile)
    {
        $fields = $this->getFields();
        $condition = $this->getCondition($excludedGameID, $gameType, $isMobile);
        $orderBy = $this->getOrderBy();
        $this->setResults($fields, $condition, $orderBy);
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

    private function getCondition($excludedGameID, $gameType, $isMobile)
    {
        $statement = \Lucinda\SQL\ConnectionSingleton::getInstance()->createStatement();

        $gmc = new \Hlis\GameManufacturerCondition();
        $gmc->setIsOpen();

        $gtc = new \Hlis\GameTypeCondition();
        $gtc->setName($statement->quote($gameType));

        $condition = new \Hlis\GameCondition();
        $condition->setIsOpen();
        $condition->setManufacturer($gmc);
        $condition->setType($gtc);
        if ($isMobile) {
            $condition->setIsMobile();
        } else {
            $condition->setIsDesktop();
        }
        $condition->setId($excludedGameID);

        return $condition;
    }

    private function getOrderBy()
    {
        $orderBy = new \Hlis\GameSort();
        $orderBy->setDateLaunched(false);
        $orderBy->setId(false);
        return $orderBy;
    }

    private function setResults(\Hlis\GameFields $fields, \Hlis\GameCondition $condition, \Hlis\GameSort $orderBy)
    {
        $gld  = new \Hlis\GameListDAO(
            new \CasinosLists\GamesRecommendedQuery($fields, $condition, $orderBy, 0, self::LIMIT),
            new \CasinosLists\GameLineProcessor()
        );
        $this->results = $gld->getResults();
    }

    public function getResults()
    {
        return $this->results;
    }
}
