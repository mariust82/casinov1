<?php
require_once 'dao/Casinos.php';
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
    private $currency_accepted = false;
    private $lang_accepted = false;
    private $free_bonus = false;
    private $promoted = false;

    private $banking_method;
    private $label;
    private $bonus_type;
    private $country;
    public $currency_id;
    public $language_id;
    private $software;
    private $game;

    private $operating_system;
    private $play_version;
    private $high_roller = false;
    private $certification;
    private $bonus_types = [];
    private $play_version_type;

    public function __construct($requestParameters, Country $detectedCountry)
    {
        $this->detectedCountry = $detectedCountry;
        if (isset($requestParameters['country'])) {
            $countries = new Countries();
            $result = $countries->getCountryDetails($requestParameters['country']);
            $this->currency_id = $result[0]['c_id'];
            $this->language_id = $result[0]['l_id'];
        }
        $booleans = array("country_accepted","currency_accepted","lang_accepted","free_bonus", "promoted");
        foreach ($booleans as $item) {
            $this->$item =  !empty($requestParameters[$item]);
        }

        $strings = array("banking_method", "label", "bonus_type", "country", "software", "game");
        foreach ($strings as $item) {
            $this->$item =  (!empty($requestParameters[$item])?preg_replace("/[^a-zA-Z0-9\ \.\@\-\(\)]/", "", $requestParameters[$item]):"");
        }
        

        if (!empty($requestParameters["compatibility"])) {
            $compatibility = strtolower($requestParameters["compatibility"]);
            if (in_array($compatibility, array("flash","mobile"))) {
                $this->play_version = $compatibility;
            } else {
                $this->operating_system = preg_replace("/[^a-z]/", "", $compatibility);
            }
        }

        if (!empty($requestParameters["feature"])) {
            $feature = $requestParameters["feature"];
            switch ($feature) {
                case "Live Dealer":
                    $this->play_version = $feature;
                    break;
                case "ECOGRA Casinos":
                    $this->certification = "ecogra";
                    break;
                default:
                    $this->play_version = "Live Dealer";
                    $this->play_version_type = $requestParameters["feature"];
                    $this->country = ""; // force empty result
                    break;
            }
        }
        // start hardcodings
        switch ($this->country) {
            case "Democratic Peoples Republic Of Korea":
                $this->country = "Democratic People\'s Republic of Korea";
                break;
            case "Cote DIvoire":
                $this->country = "Cote D\'Ivoire";
                break;
            case "Lao Peoples Democratic Republic":
                $this->country = "Lao People\'s Democratic Republic";
                break;
        }
        if ($this->operating_system && $this->operating_system=="iphone") {
            $this->operating_system = "iOS";
        }

        if (!empty($requestParameters["live_dealer"])) {
            $this->play_version = 'Live Dealer';
            $this->play_version_type = $requestParameters["live_dealer"];
        }



        /*  if(!empty($requestParameters['bonus_types'])){
              $this->bonus_types = $requestParameters['bonus_types'];*/
    //    }
      //  var_dump($requestParameters);
        // end hardcodings
    }

    public function getCountryAccepted()
    {
        return $this->country_accepted;
    }

    public function setCountryAccepted($data)
    {
        $this->country_accepted = $data;
    }
    
    public function getCurrencyAccepted()
    {
        return $this->currency_accepted;
    }

    public function setCurrencyAccepted($data)
    {
        $this->currency_accepted = $data;
    }
    
    public function getLanguageAccepted()
    {
        return $this->lang_accepted;
    }

    public function setLanguageAccepted($data)
    {
        $this->lang_accepted = $data;
    }
    
    public function getCurrencyID()
    {
        return $this->currency_id;
    }

    public function setCurrencyID($data)
    {
        $this->currency_id = $data;
    }
    
    public function getLanguageID()
    {
        return $this->language_id;
    }

    public function setLanguageID($data)
    {
        $this->language_id = $data;
    }

    public function getFreeBonus()
    {
        return $this->free_bonus;
    }

    public function setFreeBonus($data)
    {
        $this->free_bonus = $data;
    }

    public function getBankingMethod()
    {
        return $this->banking_method;
    }

    public function setBankingMethod($data)
    {
        $this->banking_method = $data;
    }

    public function getPromoted()
    {
        return $this->promoted;
    }

    public function setPromoted($data)
    {
        $this->promoted = $data;
    }

    public function getCasinoLabel()
    {
        return $this->label = $this->label == 'Stay away' ? 'Blacklisted Casinos' : $this->label;
    }

    public function setCasinoLabel($data)
    {
        $this->label = $data;
    }

    public function getBonusType()
    {
        return $this->bonus_type;
    }

    public function setBonusType($data)
    {
        $this->bonus_type = $data;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($data)
    {
        $this->country = $data;
    }

    public function getSoftware()
    {
        return $this->software;
    }

    public function setSoftware($data)
    {
        $this->software = $data;
    }

    public function getOperatingSystem()
    {
        return $this->operating_system;
    }

    public function setOperatingSystem($data)
    {
        $this->operating_system = $data;
    }

    public function getPlayVersion()
    {
        return $this->play_version;
    }

    public function setPlayVersion($data)
    {
        $this->play_version = $data;
    }

    public function getHighRoller()
    {
        return $this->high_roller;
    }

    public function setHighRoller($data)
    {
        $this->high_roller = $data;
    }

    public function getCertification()
    {
        return $this->certification;
    }

    public function setCertification($data)
    {
        $this->certification = $data;
    }

    public function getDetectedCountry()
    {
        return $this->detectedCountry;
    }

    public function setDetectedCountry($data)
    {
        $this->detectedCountry = $data;
    }

    public function getGame()
    {
        return $this->game;
    }

    public function setGame($data)
    {
        $this->game = $data;
    }

    public function getPlayVersionType()
    {
        return $this->play_version_type;
    }

    public function setPlayVersionType($data)
    {
        $this->play_version_type = $data;
    }
}
