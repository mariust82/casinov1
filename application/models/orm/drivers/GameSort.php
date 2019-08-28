<?php
namespace CasinosLists;

class GameSort extends \Hlis\GameSort
{
    public function __construct() {
        $this->fields = new Game();
    }

    public function setTimesPlayed($asc=true)
    {
        $this->fields->times_played = true;
        $this->order["times_played"] = $asc;
    }
}