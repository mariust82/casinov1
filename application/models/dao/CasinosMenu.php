<?php
require_once("entities/MenuItem.php");

class CasinosMenu
{
    const ENTRIES = [
        "/countries-list/{country}"=>"{country} Casinos",
        "/{page}"=>"{entity} Casinos",
        "/bonus-list/no-deposit-bonus"=>"No Deposit Casinos",
        "/casinos/best"=>"Best Casinos",
        "/casinos/low-minimum-deposit"=>"Low Minimum Deposit Casinos",
        "/casinos/mobile"=>"Mobile Casinos",
        "/casinos/low-wagering" => "Low Wagering Casinos",
        "/casinos/fast-payout" => "Fast Payout Casinos",
        "/casinos/new"=>"New Casinos",
        "/casinos/stay-away"=>"Blacklisted Casinos",
        "/casinos/no-account-casinos" => "No Account Casinos",
        "/casinos"=>"All Casinos",
    ];
    public $soft_arr;
    public $soft_entries;
    
    public function setSoftwareEntries($entity)
    {
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

    public function __construct($country, $entity, $currentPage)
    {
        $this->soft_arr = array("RTG","Rival","NetEnt","Playtech","MicroGaming","BetSoft","Saucify","Cryptologic","IGT","NYX Interactive");
        $this->setSoftwareEntries($entity);
        $this->setEntries($country, $entity, $currentPage);
    }

    private function setEntries($country, $entity, $currentPage)
    {
        $selectedEntry = $this->getSelectedEntry($country, $currentPage, $entity);
        if (strpos($selectedEntry, "/softwares/") !== false) {
            foreach ($this->soft_entries as $url=>$title) {
                if (strpos($title, $entity) !== false) {
                    unset($this->soft_entries['/softwares/'.strtolower(str_replace(' ', '-', $entity))]);
                }
                
                $object = new MenuItem();
                $object->title = $title;
                $object->url = $url;
                $object->is_active = $url==$selectedEntry;
                $this->pages[] = $object;
            }
        } else {
            foreach (self::ENTRIES as $url=>$title) {
                if ($selectedEntry != "/{page}" && $url == "/{page}") {
                    continue;
                }

                $finalTitle = $title;
                $finalUrl = $url;
                if ($url=="/countries-list/{country}") {
                    $finalTitle = str_replace("{country}", $country, $finalTitle);
                    $finalUrl = str_replace("{country}", $this->generatePathParameter($country), $finalUrl);
                } elseif ($url=="/{page}") {
                    // hardcoding: CASLI-316
                    $entity = ($entity=="ECOGRA Casinos"?"eCOGRA":$entity);
                    $finalTitle = str_replace("{entity}", $entity, $finalTitle);
                    $finalUrl = "/".$currentPage;
                }

                $object = new MenuItem();
                $object->title = $finalTitle;
                $object->url = $finalUrl;
                $object->is_active = $url==$selectedEntry;
                $this->pages[] = $object;
            }
        }
    }

    private function getSelectedEntry($country, $currentPage, $entity="")
    {
        switch ($currentPage) {
            case "bonus-list/no-deposit-bonus":
                return "/bonus-list/no-deposit-bonus";
            case "casinos/best":
                return "/casinos/best";
            case "casinos/new":
                return "/casinos/new";
            case "casinos/mobile":
                return "/casinos/mobile";
            case "casinos/low-wagering":
                return "/casinos/low-wagering";
            case "casinos/recommended":
                return "/casinos/recommended";
            case "casinos/stay-away":
                return "/casinos/stay-away";
            case "softwares/".strtolower(str_replace(' ', '-', $entity)):
                return "/softwares/".strtolower(str_replace(' ', '-', $entity));
            case "countries-list/".$this->generatePathParameter($country):
                return "/countries-list/{country}";
            case "casinos/no-account-casinos":
                 return "/casinos/no-account-casinos";
            default:
                return "/{page}";
        }
    }

    public function getEntries()
    {
        return $this->pages;
    }

    private function generatePathParameter($name)
    {
        return strtolower(str_replace(" ", "-", str_replace(["(",")","'"],["","",""], $name)));
    }
}
