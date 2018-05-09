<?php
class GameFilter
{
    private $game_type;
    private $software = array();
    public $is_mobile;

    public function __construct($requestParameters) {
        $this->game_type = (!empty($requestParameters["game_type"])?preg_replace("/[^a-zA-Z0-9\ \.\@\-\(\)]/","", $requestParameters["game_type"]):"");
        $this->is_mobile = FALSE;
        if(!empty($requestParameters["software"])) {
            $softwares = explode(",", $requestParameters["software"]);
            foreach($softwares as $item) {
                $this->software[] =  preg_replace("/[^a-zA-Z0-9\ \.\@\-\(\)]/","", $item);
            }
        }
    }

    public function getGameType() {
        return $this->game_type;
    }

    public function getSoftwares() {
        return $this->software;
    }
}