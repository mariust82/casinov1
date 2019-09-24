<?php
namespace CasinosLists;

require_once(dirname(__DIR__, 3)."/hlis/orm/src/dao/GameInfoDAO.php");
require_once("drivers/GameFields.php");
require_once("drivers/GameLineProcessor.php");
require_once(dirname(__DIR__, 3)."/vendor/lucinda/queries/src/Select.php");

class GameInfo
{
    private $results;

    public function __construct($gameID)
    {
        $fields = $this->getFields();
        $this->setResults($fields, $gameID);
    }

    private function getFields()
    {
        $gmf = new \Hlis\GameManufacturerFields();
        $gmf->setName();

        $gtf = new \Hlis\GameTypeFields();
        $gtf->setName();

        $fields = new \CasinosLists\GameFields();
        $fields->setId();
        $fields->setName();
        $fields->setTimesPlayed();
        $fields->setManufacturer($gmf);
        $fields->setType($gtf);
        $fields->setDateLaunched();
        $fields->setIsMobile();
        $fields->setIsFlash();
        $fields->setIsHtml5();
        $fields->setIs3dAnimation();

        return $fields;
    }

    private function setResults(\Hlis\GameFields $fields, $gameID)
    {
        $glt = new \Hlis\GameInfoDAO(
            new \Hlis\GameInfoQuery($gameID, $fields),
            new \CasinosLists\GameLineProcessor()
        );
        $this->results = $glt->getResults();
    }

    public function getResults()
    {
        return $this->results;
    }
}
