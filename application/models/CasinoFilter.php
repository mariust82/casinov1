<?php
/**
 * Created by PhpStorm.
 * User: aherne
 * Date: 19.01.2018
 * Time: 11:30
 */

class CasinoFilter
{
    private $detectedCountry;

    private $country_accepted = false;
    private $free_bonus = false;
    private $promoted = false;

    private $banking_method;
    private $label;
    private $bonus_type;
    private $country;
    private $software;
    private $game;

    private $operating_system;
    private $play_version;
    private $high_roller = false;
    private $certification;

    public function __construct($requestParameters, Country $detectedCountry) {
        $this->detectedCountry = $detectedCountry;

        $booleans = array("country_accepted", "free_bonus", "promoted");
        foreach($booleans as $item) {
            $this->$item =  !empty($requestParameters[$item]);
        }

        $strings = array("banking_method", "label", "bonus_type", "country", "software", "game");
        foreach($strings as $item) {
            $this->$item =  (!empty($requestParameters[$item])?preg_replace("/[^a-zA-Z0-9\ \.\@\-\(\)]/","", $requestParameters[$item]):"");
        }

        if(!empty($requestParameters["compatibility"])) {
            $compatibility = strtolower($requestParameters["compatibility"]);
            if(in_array($compatibility, array("flash","mobile"))) {
                $this->play_version = $compatibility;
            } else {
                $this->operating_system = preg_replace("/[^a-z]/","", $compatibility);
            }
        }

        if(!empty($requestParameters["feature"])) {
            $feature = $requestParameters["feature"];
            switch($feature) {
                case "Live Dealer":
                    $this->play_version = $feature;
                    break;
                case "eCOGRA Casinos":
                    $this->certification = "ecogra";
                    break;
                case "High Roller Casinos":
                    $this->high_roller = true;
                    break;
                default:
                    $this->country = "AAA"; // force empty result
                    break;
            }
        }

        // start hardcodings
        switch($this->country) {
            case "Democratic Peoples Republic of Korea":
                $this->country = "Democratic People\'s Republic of Korea";
                break;
            case "Cote DIvoire":
                $this->country = "Cote D\'Ivoire";
                break;
            case "Lao Peoples Democratic Republic":
                $this->country = "Lao People\'s Democratic Republic";
                break;
        }
        if($this->operating_system && $this->operating_system=="iphone") {
            $this->operating_system = "iOS";
        }
        // end hardcodings
    }

    public function getCountryAccepted() {
        return $this->country_accepted;
    }

    public function getFreeBonus() {
        return $this->free_bonus;
    }
    
    public function setPromoted($value) {
        $this->promoted = $value;
    }

    public function getBankingMethod() {
        return $this->banking_method;
    }

    public function getPromoted() {
        return $this->promoted;
    }

    public function getCasinoLabel() {
        return $this->label;
    }

    public function getBonusType() {
        return $this->bonus_type;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getSoftware() {
        return $this->software;
    }

    public function getOperatingSystem() {
        return $this->operating_system;
    }

    public function getPlayVersion() {
        return $this->play_version;
    }

    public function getHighRoller() {
        return $this->high_roller;
    }

    public function getCertification() {
        return $this->certification;
    }

    public function getDetectedCountry() {
        return $this->detectedCountry;
    }

    public function getGame() {
        return $this->game;
    }
}