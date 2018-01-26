<?php
require_once("dao/entities/GamePlay.php");

/**
 * Encapsulates generation of game play link
 */
class GamePlayer 
{
    private $repo_path, $width, $height, $isRequestHTTPS;

    /**
     * GamePlayer constructor.
     *
     * @param string $repo_path Relative path to images repo folder.
     * @param integer $width Play window width.
     * @param integer $height Play window height.
     * @param boolean $isRequestHTTPS Whether or not app was requested as HTTPS.
     */
    public function __construct($repo_path, $width, $height, $isRequestHTTPS) {
        $this->repo_path = $repo_path;
        $this->width  = $width;
        $this->height = $height;
        $this->isRequestHTTPS = $isRequestHTTPS;
    }

    /**
     * Compiles a game play object based on inputs received.
     *
     * @param string $game_name Name of game to be played.
     * @param string $pattern Play link pattern
     * @param string $matches Play link matches that must replace placeholders in pattern above.
     * @param string $status Play type supported (eg: Auto Play).
     * @return GamePlay
     */
    public function compile($game_name, $pattern, $matches, $status)
    {
        $object = new GamePlay();
        $object->width = $this->width;
        $object->height = $this->height;
        $object->screenshot = $this->getScreenshot($game_name);
        $object->status = $this->getStatus($status, $pattern);
        if($object->status == null) {
            $object->url = $object->screenshot;
        } else {
            $object->url = $this->getUrl($pattern, $matches, $status);
        }
        return $object;
    }

    /**
     * Compiles play link based on pattern, matches and status
     *
     * @param string $pattern Play link pattern
     * @param string $matches Play link matches that must replace placeholders in pattern above.
     * @param string $status Play type supported (eg: Auto Play).
     * @return string Value of play link.
     */
    private function getUrl($pattern, $matches, $status){
        $output = "";
        if(!$status || $status=="unavailable") {
            $output = "";
        } else {
            $token=mt_rand(100000,mt_getrandmax());
            $template_url = $pattern;
            $template_url = str_replace("{MODULE}", $matches, $template_url);
            $template_url = str_replace("{WIDTH}", $this->width, $template_url);
            $template_url = str_replace("{HEIGHT}", $this->height, $template_url);
            $template_url = str_replace("{TOKEN}", $token, $template_url);
            if(strpos($template_url, "{MODULE_1}")!==false) {
                $parts = explode(",",$matches);
                foreach($parts as $i=>$part) {
                    $template_url = str_replace("{MODULE_".($i+1)."}", $part, $template_url);
                }
            }
            $output = $template_url;
        }
        return $output;
    }

    /**
     * Detects play status based on play status associated to game.
     *
     * @param string $status Play type supported (eg: Auto Play).
     * @param string $pattern Play link pattern
     * @return string Play type validated.
     */
    private function getStatus($status, $pattern) {
        if(!$status) {
            $status = "screenshot";
        } else if($this->isRequestHTTPS && strpos($pattern, "https")===false) {
            $status = "click-popup-play";
        }
        return $status;
    }

    /**
     * Generates screenshot path based on game name.
     *
     * @param string $game_name Name of game to be played
     * @return string Relative screenshot path
     */
    public function getScreenshot($game_name) {
        return $this->repo_path."/game_ss/".$this->width."x".$this->height."/".str_replace(" ", "_", $game_name)."_ss.jpg";
    } 
    
    
}
