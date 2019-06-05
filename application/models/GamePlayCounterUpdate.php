<?php
class GamePlayCounterUpdate
{
    public function __construct(\Lucinda\MVC\STDOUT\Session $session, $currentGameID)
    {
        $games_played = $this->getGamesPlayed($session, $currentGameID);
        $this->setGamesPlayed($session, $currentGameID, $games_played);
    }

    private function getGamesPlayed(\Lucinda\MVC\STDOUT\Session $session, $currentGameID)
    {
        $games_played = [];
        if(!$session->isStarted()) {
            $session->start();
        }
        if($session->contains("games_played")) {
            $games_played = $session->get("games_played");
            if(isset($games_played[$currentGameID])) {
                throw new OperationFailedException("Game already played!");
            }
        }
        return $games_played;
    }

    private function setGamesPlayed(\Lucinda\MVC\STDOUT\Session $session, $currentGameID, $games_played) {
        SQL("UPDATE games SET times_played = times_played + 1 WHERE id=:id",array(":id"=>$currentGameID));
        $games_played[$currentGameID] = $currentGameID;
        $session->set("games_played", $games_played);
    }
}