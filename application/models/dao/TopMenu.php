<?php
require_once("entities/MenuItem.php");

class TopMenu
{
    const ENTRIES = [
        "CASINOS"=>"/casinos",
        "SOFTWARES"=>"/softwares",
        "BONUSES"=>"/bonus-list",
        "COUNTRIES"=>"/countries",
        "COMPATIBILITY"=>"/compatability",
        "BANKING"=>"/banking",
        "FEATURES"=>"/features",
        "GAMES"=>"/games",

    ];
    private $pages = array();

    public function __construct($currentPage) {
        $this->setEntries($currentPage);
    }

    private function setEntries($currentPage) {
        $selectedEntry = $this->getSelectedEntry($currentPage);
        foreach(self::ENTRIES as $title=>$url) {
            $object = new MenuItem();
            $object->title = $title;
            $object->url = $url;
            $object->is_active = ($title==$selectedEntry?true:false);
            $this->pages[] = $object;
        }
    }

    private function getSelectedEntry($currentPage) {
        switch($currentPage) {
            case "casinos":
            case "casinos/(name)":
                return "CASINOS";
                break;
            case "softwares":
            case "softwares/(name)":
                return "SOFTWARES";
                break;
            case "bonus-list":
            case "bonus-list/(name)":
                return "BONUSES";
                break;
            case "countries":
            case "countries-list/(name)":
                return "COUNTRIES";
                break;
            case "compatability":
            case "compatability/(name)":
                return "COMPATIBILITY";
                break;
            case "banking":
            case "banking/(name)":
                return "BANKING";
                break;
            case "features":
            case "features/(name)":
                return "FEATURES";
                break;
            case "features":
            case "features/(name)":
                return "FEATURES";
                break;
            case "games":
            case "games/(type)":
            case "play/(name)":
                return "GAMES";
                break;
            default:
                return "";
                break;
        }
    }

    public function getEntries() {
        return $this->pages;
    }
}