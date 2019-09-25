<?php
namespace CasinosLists;

require_once("Game.php");

class GameFields extends \Hlis\GameFields
{
    public function __construct()
    {
        $this->fields = new Game();
    }

    public function setTimesPlayed()
    {
        $this->fields->times_played = true;
    }
}
