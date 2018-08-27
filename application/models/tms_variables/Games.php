<?php

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
}