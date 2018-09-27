<?php
require_once 'application/models/tms_variables/GamesTms/GamesTms.php';


class  Games extends  \TMS\VariablesHolder {

    public function getNumberOfGamesInTheCurrentList(){

        $totalGames = !empty($this->parameters["response"]->getAttribute("total_games")) ? $this->parameters["response"]->getAttribute("total_games") : '';
        return $totalGames;
    }

    public function getNumberOfGamesInSite(){

        $casinoCount = DB("
          SELECT COUNT(id) FROM games  
        ")->toValue();

        return $casinoCount;
    }

    public function getNewestGameInSite(){

       $game =   DB("
            SELECT t1.name
            FROM games AS t1
            ORDER BY t1.id DESC LIMIT 1
          ")->toRow();

       return $game['name'];
    }

    public function getNewestGameInCurrentList(){

       $selected_entity =  $this->parameters["response"]->getAttribute("selected_entity");
       $filterPage = !empty($this->parameters["response"]->getAttribute("filter")) ? $this->parameters["response"]->getAttribute("filter") : null;

       if(
           empty($selected_entity)||
           empty($filterPage) ||
           !$filterPage instanceof GameFilter
       ) {
           return '';
       }

        $gamesTms = new GamesTms($filterPage);
        $result = $gamesTms->getData(GameSortCriteria::NEWEST, 1, 1);
        $name = !empty($result[key($result)]->name) ? $result[key($result)]->name : '';

        return $name;
    }

    public function getMostPopularGameInSite(){

        $game =   DB("
            SELECT t1.name
            FROM games AS t1
            ORDER BY t1.times_played DESC LIMIT 1
          ")->toRow();

        return $game['name'];
    }

    public function getMostPopularGameInCurrentList(){

        $selected_entity =  $this->parameters["response"]->getAttribute("selected_entity");
        $filterPage = !empty($this->parameters["response"]->getAttribute("filter")) ? $this->parameters["response"]->getAttribute("filter") : null;
        if(
            empty($selected_entity)||
            empty($filterPage) ||
            !$filterPage instanceof GameFilter
        ) {
            return '';
        }

        $gamesTms = new GamesTms($filterPage);
        $result = $gamesTms->getData(GameSortCriteria::MOST_PLAYED, 1, 1);
        $name = !empty($result[key($result)]->name) ? $result[key($result)]->name : '';

        return $name;
    }

    public function getSoftwareOfNewestGameInSite(){

        $game_manufacturers =   DB("
            SELECT t2.name
            FROM games AS t1
            INNER JOIN game_manufacturers AS t2 ON
              t1.game_manufacturer_id = t2.id 
            ORDER BY t1.id DESC LIMIT 1
          ")->toRow();

        return $game_manufacturers['name'];
    }

    public function getSoftwareOfNewestGameInCurrentList(){

        $selected_entity =  $this->parameters["response"]->getAttribute("selected_entity");
        $filterPage = !empty($this->parameters["response"]->getAttribute("filter")) ? $this->parameters["response"]->getAttribute("filter") : null;

        if(
            empty($selected_entity)||
            empty($filterPage) ||
            !$filterPage instanceof GameFilter
        ) {
            return '';
        }

        $gamesTms = new GamesTms($filterPage);
        $result = $gamesTms->getData(GameSortCriteria::NEWEST, 1, 1);
        $name = !empty($result[key($result)]->software) ? $result[key($result)]->software : '';
        return $name;
    }

    public function getSoftwareOfTheMostPopularGameInSite(){

        $game_manufacturers =   DB("
            SELECT t2.name
            FROM games AS t1
            INNER JOIN game_manufacturers AS t2 ON
              t1.game_manufacturer_id = t2.id 
            ORDER BY t1.times_played DESC LIMIT 1
          ")->toRow();

        return $game_manufacturers['name'];
    }

    public function getSoftwareOfTheMostPopularGameInCurentList(){

        $selected_entity =  $this->parameters["response"]->getAttribute("selected_entity");
        $filterPage = !empty($this->parameters["response"]->getAttribute("filter")) ? $this->parameters["response"]->getAttribute("filter") : null;

        if(
            empty($selected_entity)||
            empty($filterPage) ||
            !$filterPage instanceof GameFilter
        ) {
            return '';
        }

        $gamesTms = new GamesTms($filterPage);
        $result = $gamesTms->getData(GameSortCriteria::MOST_PLAYED, 1, 1);
        $name = !empty($result[key($result)]->software) ? $result[key($result)]->software : '';

        return $name;
    }
}