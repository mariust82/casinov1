<?php
namespace CasinosLists;

require_once("Game.php");

class GameCondition extends \Hlis\GameCondition
{
    public function __construct()
    {
        $this->condition = new Game();
    }
}
