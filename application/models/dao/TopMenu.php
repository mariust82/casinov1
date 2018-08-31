<?php
require_once("entities/MenuItem.php");

class TopMenu
{

    private $userCountry;

     public  function __connstruct($user_country = ''){

         $this->userCountry = $user_country;

    }

    const ENTRIES = [

        "NO DEPOSIT CASINOS"=>[
            "item_url" => "/bonus-list/no-deposit-bonus",
            "sub_items" => [
            ]
        ],

        "NEW CASINOS"=>[
            "item_url" => "casinos/new",
            "sub_items" => [
            ]
        ],

        "CASINOS"=>[
           "item_url" => "/casinos",
            "sub_items" => [
                "Best Casinos" => "/casinos/best",
                "Live Casinos" => "/features/live-dealer",
                "Mobile Casinos" => "/compatability/mobile",
                "eCOGRA Casinos" => "/features/ecogra-casinos",
                "Stay Away Casinos" => "/casinos/stay-away",
                "Popular Casinos" => "/casinos/popular",
                "All Casinos" => "/casinos"
            ]
        ],
        "SOFTWARES"=>[
            'item_url' => "/softwares",
            'sub_items'=>[
                'RTG Casinos' => '/softwares/rtg',
                'Rival Casinos' => '/softwares/rival',
                'NetEnt Casinos' => '/softwares/netent',
                'Playtech Casinos' => '/softwares/playtech',
                'MicroGaming Casinos' => '/softwares/microgaming',
                'BetSoft Casinos' => '/softwares/betsoft',
                'Saucify Casinos' => '/softwares/saucify',
                'Cryptologic Casinos' => '/softwares/cryptologic',
                'All Softwares' => '/softwares',
            ],
        ],
       /* "BONUSES"=>[
            "item_url" => "/bonus-list",
            "sub_items"=>[],
        ],*/
        "COUNTRIES"=>[
            "item_url" =>"/countries",
            "sub_items"=>[
                'USA Casinos' => '/countries-list/united-states',
                'UK Casinos' => '/countries-list/united-kingdom',
                'Australia Casinos' => '/countries-list/australia',
                'Germany Casinos' => '/countries-list/germany',
                'New Zealand Casinos' => '/countries-list/new-zealand',
                'Netherlands Casinos' => '/countries-list/netherlands',
                'Sweden Casinos' => '/countries-list/sweden',
                'All Countries' => '/countries '
            ],
        ],
        "BANKING"=>[
            "item_url" =>"/banking",
            "sub_items"=>[
                'Neteller Casinos' =>'',
                'Skrill Moneybookers Casinos' => '',
                'PayPal Casinos' => '',
                'Bitcoin Wallets Casinos' => '',
                'EcoPayz EcoCard Casinos' => '',
                'Paysafe Card' => '',
                'All Banking' => '/banking'
            ],
        ],
        "GAMES"=>[
            "item_url" =>"/games",
            "sub_items"=>[
                'Video Slots' => '',
                'Classic Slots' => '',
                'Video Poker' => '',
                'Scratch Cards' => '',
                'Blackjack' => '',
                'Roulette' => '',
                'Table Games' => '',
                'Bingo' => '',
                'Baccarat' => '',
                'Craps' => '',
                'Keno' => '',
                'Other' => '',
                'All Games' => '/games'

            ],
        ],

    ];
    private $pages = array();

    public function __construct($currentPage) {
        $this->setEntries($currentPage);
    }

    private function setEntries($currentPage) {
        $selectedEntry = $this->getSelectedEntry($currentPage);
        foreach(self::ENTRIES as $title=>$entry_data) {
            $object = new MenuItem();
            $object->title = $title;
            $object->url = $entry_data['item_url'];
            $object->is_active = ($title==$selectedEntry?true:false);

            if(!empty($entry_data["sub_items"])){
                $object->have_submenu = true;
                foreach($entry_data["sub_items"] as $subItemTitle => $subItemUrl){
                    $object->submenuItems[$subItemTitle] = $subItemUrl;
                }
            }
            $this->pages[] = $object;
        }

       /* echo '<pre>';
        print_r($this->pages);
        echo '</pre>';

        var_dump($this->pages); die();*/
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
                return "BANKINGsss";
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