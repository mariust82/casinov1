<?php
require_once 'application/models/tms_variables/GamesTms/GamesTms.php';


class Games extends \TMS\VariablesHolder
{
    public function getNumberOfGamesInTheCurrentList()
    {
        $totalGames = !empty($this->parameters["response"]->attributes("total_games")) ? $this->parameters["response"]->attributes("total_games") : '';
        return $totalGames;
    }

    public function getNumberOfGamesInSite()
    {
        $casinoCount = SQL("
          SELECT COUNT(id) FROM games  
        ")->toValue();

        return $casinoCount;
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
        $request = (array) $this->parameters["request"];
        var_dump($this->parameters);
        var_dump($request);
        $gamesTms = new GamesTms($request);
        $result = $gamesTms->getData(GameSortCriteria::NEWEST, 1, 1);
        $name = !empty($result['list'][0]->name) ? $result['list'][0]->name : '';
        return $name;
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
        $result = $gamesTms->getData(GameSortCriteria::MOST_PLAYED, 1, 1);
        $name = !empty($result['list'][0]->name) ? $result['list'][0]->name : '';
        return $name;
        
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
        $result = $gamesTms->getData(GameSortCriteria::NEWEST, 1, 1);
        $name = !empty($result['list'][0]->manufacturer) ? $result['list'][0]->manufacturer : '';
        return $name;
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
        $result = $gamesTms->getData(GameSortCriteria::MOST_PLAYED, 1, 1);
        $name = !empty($result['list'][0]->manufacturer) ? $result['list'][0]->manufacturer : '';
        return $name;
    }
}
