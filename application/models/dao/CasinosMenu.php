<?php
require_once("entities/MenuItem.php");

class CasinosMenu
{
    const ENTRIES = [
        "/countries-list/{country}"=>"{country} Casinos",
        "/{page}"=>"{entity} Casinos",
        "/bonus-list/no-deposit-bonus"=>"No Deposit Casinos",
        "/casinos/best"=>"Best Casinos",
        "/casinos/mobile"=>"Mobile Casinos",
        "/casinos/new"=>"New Casinos",
        "/casinos/stay-away"=>"Stay Away Casinos",
        "/casinos"=>"All Casinos",
    ];
    public $soft_arr;
    public $soft_entries;
    
    public function setSoftwareEntries($entity) {
        $this->soft_entries['/softwares'] = "All Softwares";
        if (!in_array($entity, $this->soft_arr)) {
            $this->soft_entries['/softwares/'.strtolower(str_replace(' ', '-', $entity))] = $entity.' Casinos';
        } else {
            unset($this->soft_entries['/softwares/'.strtolower(str_replace(' ', '-', $entity))]);
            $this->soft_entries['/softwares/'.strtolower(str_replace(' ', '-', $entity))] = $entity.' Casinos';
        }
        
        for ($i =0;$i<count($this->soft_arr);$i++) {
            $this->soft_entries['/softwares/'.strtolower(str_replace(' ', '-', $this->soft_arr[$i]))] = $this->soft_arr[$i].' Casinos';
        }
    }
    
    private $pages = array();

    public function __construct($country, $entity, $currentPage) {
        $this->soft_arr = array("RTG","Rival","NetEnt","Playtech","MicroGaming","BetSoft","Saucify","Cryptologic","IGT","NYX Interactive");
        $this->setSoftwareEntries($entity);
        $this->setEntries($country, $entity, $currentPage);
    }

    private function setEntries($country, $entity, $currentPage) {
        $selectedEntry = $this->getSelectedEntry($country, $currentPage, $entity);
        if (strpos($selectedEntry, "/softwares/") !== FALSE) {
            foreach($this->soft_entries as $url=>$title) {
                if (strpos($title, $entity) !== FALSE) {
                    unset($this->soft_entries['/softwares/'.strtolower(str_replace(' ', '-', $entity))]);
                }
                
                $object = new MenuItem();
                $object->title = $title;
                $object->url = $url;
                $object->is_active = ($url==$selectedEntry?true:false);
                $this->pages[] = $object;
            }
        } else {
        
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
    }

    private function getSelectedEntry($country, $currentPage , $entity="") {

        switch($currentPage) {
            case "bonus-list/no-deposit-bonus":
                return "/bonus-list/no-deposit-bonus";
                break;
            case "casinos/best":
                return "/casinos/best";
                break;
            case "casinos/new":
                return "/casinos/new";
                break;
            case "casinos/mobile":
                return "/casinos/mobile";
                break;
            case "casinos/recommended":
                return "/casinos/recommended";
                break;
            case "casinos/stay-away":
                return "/casinos/stay-away";
                break;
            case "softwares/".strtolower(str_replace(' ', '-', $entity)):
                return "/softwares/".strtolower(str_replace(' ', '-', $entity));
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