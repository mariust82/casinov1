<?php
require_once("entities/MenuItem.php");

class CasinosMenu
{
    const ENTRIES = [
        "/countries-list/{country}"=>"{country} Casinos",
        "/{page}"=>"{entity} Casinos",
        "/bonus-list/no-deposit-bonus"=>"No Deposit Casinos",
        "/casinos/best"=>"Best Casinos",
        "/casinos/safe"=>"Safe Casinos",
        "/casinos/new"=>"New Casinos",
        "/casinos/recommended"=>"Recommended Casinos",
        "/casinos/stay-away"=>"Stay Away Casinos",
    ];
    private $pages = array();

    public function __construct($country, $entity, $currentPage) {
        $this->setEntries($country, $entity, $currentPage);
    }

    private function setEntries($country, $entity, $currentPage) {
        $selectedEntry = $this->getSelectedEntry($country, $currentPage);
        foreach(self::ENTRIES as $url=>$title) {
            if($selectedEntry != "/{page}" && $url == "/{page}") continue;

            $finalTitle = $title;
            $finalUrl = $url;
            if($url=="/countries-list/{country}") {
                $finalTitle = str_replace("{country}", $country, $finalTitle);
                $finalUrl = str_replace("{country}", $this->generatePathParameter($country), $finalUrl);
            } else if($url=="/{page}") {
                $finalTitle = str_replace("{entity}", $entity, $finalTitle);
                $finalUrl = "/".$currentPage;
            }

            $object = new MenuItem();
            $object->title = $finalTitle;
            $object->url = $finalUrl;
            $object->is_active = ($url==$selectedEntry?true:false);
            $this->pages[] = $object;
        }
    }

    private function getSelectedEntry($country, $currentPage) {
        switch($currentPage) {
            case "bonus-list/no-deposit-bonus":
                return "/bonus-list/no-deposit-bonus";
                break;
            case "casinos/best":
                return "/casinos/best";
                break;
            case "casinos/safe":
                return "/casinos/safe";
                break;
            case "casinos/new":
                return "/casinos/new";
                break;
            case "casinos/recommended":
                return "/casinos/recommended";
                break;
            case "casinos/stay-away":
                return "/casinos/stay-away";
                break;
            case "countries-list/".$this->generatePathParameter($country):
                return "/countries-list/{country}";
                break;
            default:
                return "/{page}";
                break;

        }
    }

    public function getEntries() {
        return $this->pages;
    }

    private function generatePathParameter($name) {
        return strtolower(str_replace(" ", "-", $name));
    }
}