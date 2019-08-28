<?php
namespace CasinosLists;

class GameLineProcessor extends \Hlis\GameLineProcessor
{
    public function process($row) {
        $game = parent::process($row);
        $game->date_launched = ($game->date_launched?date("M j, Y", strtotime($game->date_launched)):"");
        $game->logo = "/public/sync/game_ss/300x220/".str_replace(" ","_", $row["name"])."_ss.jpg";
        return $game;
    }
}