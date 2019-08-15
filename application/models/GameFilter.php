<?php
class GameFilter
{
    private $game_type;
    private $software = array();
    private $is_mobile;
    private $not_current_game;

    public function __construct($requestParameters) {
        $this->game_type = (!empty($requestParameters["game_type"])?preg_replace("/[^a-zA-Z0-9\ \.\@\-\(\)]/","", $requestParameters["game_type"]):"");
        $this->is_mobile = !empty($requestParameters["is_mobile"]);
        $this->not_current_game = !empty($requestParameters["not_current"]);
        if(!empty($requestParameters["software"])) {
            $softwares = explode(",", $requestParameters["software"]);
            foreach($softwares as $item) {
                $this->software[] =  preg_replace("/[^a-zA-Z0-9\ \.\@\-\(\)]/","", $item);
            }
        }
    }
    
    public function getCurrentgame() {
        return $this->not_current_game;
    }

    public function getGameType() {
        return $this->game_type;
    }

    public function getSoftwares() {
        return $this->software;
    }

    public function isMobile() {
        return $this->is_mobile;
    }
}