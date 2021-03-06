<?php
require_once 'application/models/tms_variables/GamesTms/GamesTms.php';


class Games extends \TMS\VariablesHolder
{
    public function getNumberOfGamesInTheCurrentList()
    {
        return !empty($this->parameters["response"]->attributes("total_games")) ? $this->parameters["response"]->attributes("total_games") : '';
    }

    public function getNumberOfGamesInSite()
    {
        return SQL("
          SELECT COUNT(id) FROM games  
        ")->toValue();
    }

    public function getNewestGameInSite()
    {
        $game =   SQL("
            SELECT t1.name
            FROM games AS t1
            ORDER BY t1.id DESC LIMIT 1
          ")->toRow();

        return $game['name'];
    }

    public function getNewestGameInCurrentList()
    {
        $gamesTms = new GamesTms($this->parameters["request"]);
        $result = $gamesTms->getData(GameSortCriteria::NEWEST);
        return !empty($result['list'][0]->name) ? $result['list'][0]->name : '';
    }

    public function getMostPopularGameInSite()
    {
        $game =   SQL("
            SELECT t1.name
            FROM games AS t1
            ORDER BY t1.times_played DESC LIMIT 1
          ")->toRow();

        return $game['name'];
    }

    public function getMostPopularGameInCurrentList()
    {
        $gamesTms = new GamesTms($this->parameters["request"]);
        $result = $gamesTms->getData(GameSortCriteria::MOST_PLAYED);
        return !empty($result['list'][0]->name) ? $result['list'][0]->name : '';
        
    }

    public function getSoftwareOfNewestGameInSite()
    {
        $game_manufacturers =   SQL("
            SELECT t2.name
            FROM games AS t1
            INNER JOIN game_manufacturers AS t2 ON
              t1.game_manufacturer_id = t2.id 
            ORDER BY t1.id DESC LIMIT 1
          ")->toRow();

        return $game_manufacturers['name'];
    }

    public function getSoftwareOfNewestGameInCurrentList()
    {
        $gamesTms = new GamesTms($this->parameters["request"]);
        $result = $gamesTms->getData(GameSortCriteria::NEWEST);
        return !empty($result['list'][0]->manufacturer) ? $result['list'][0]->manufacturer : '';
    }

    public function getSoftwareOfTheMostPopularGameInSite()
    {
        $game_manufacturers =   SQL("
            SELECT t2.name
            FROM games AS t1
            INNER JOIN game_manufacturers AS t2 ON
              t1.game_manufacturer_id = t2.id 
            ORDER BY t1.times_played DESC LIMIT 1
          ")->toRow();

        return $game_manufacturers['name'];
    }

    public function getSoftwareOfTheMostPopularGameInCurentList()
    {
        $gamesTms = new GamesTms($this->parameters["request"]);
        $result = $gamesTms->getData(GameSortCriteria::MOST_PLAYED);
        return !empty($result['list'][0]->manufacturer) ? $result['list'][0]->manufacturer : '';
    }
}
