<?php
class GameFilter
{
    private $game_type;
    private $software;

    public function __construct($requestParameters) {
        $fields = array("game_type", "software");
        foreach($fields as $item) {
            $this->$item =  (!empty($requestParameters[$item])?preg_replace("/[^a-zA-Z0-9\ \.\@\-\(\)]/","", $requestParameters[$item]):"");
        }
    }

    public function getGameType() {
        return $this->game_type;
    }

    public function getSoftware() {
        return $this->software;
    }
}