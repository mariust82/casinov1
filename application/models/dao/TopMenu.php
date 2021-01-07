<?php
require_once("entities/MenuItem.php");

class TopMenu
{
    private $userCountry;

    private static $entries = [

        "NO DEPOSIT CASINOS"=>[
            "item_url" => "/bonus-list/no-deposit-bonus",
            "sub_items" => [
            ]
        ],

        "NEW CASINOS"=>[
            "item_url" => "/casinos/new",
            "sub_items" => [
            ]
        ],

        "LIVE"=>[
            "item_url" => "/features/live-dealer",
            "sub_items" => [
                "Live Roulette Casinos" => "/live-dealer/roulette",
                "Live Blackjack Casinos" => "/live-dealer/blackjack",
                "Live Baccarat Casinos" => "/live-dealer/baccarat",
                "Live Craps Casinos" => "/live-dealer/craps",
                "Live Dealer Casinos" => "/features/live-dealer"
            ]
        ],

        "CASINOS"=>[
           "item_url" => "/casinos",
            "sub_items" => [
                "Best Casinos" => "/casinos/best",
                "Mobile Casinos" => "/casinos/mobile",
                "Low Wagering Casinos" => "/casinos/low-wagering",
                "Fast Payout Casinos" => " /casinos/fast-payout",
                "eCOGRA Casinos" => "/features/ecogra-casinos",
                "Blacklisted Casinos" => "/casinos/stay-away",
                "No Account Casinos" => "/casinos/no-account-casinos",
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

        "COUNTRIES"=>[
            "item_url" =>"/countries",
            "sub_items"=>[
                'USA Casinos' => '/countries-list/united-states',
                'UK Casinos' => '/countries-list/united-kingdom',
                'Australia Casinos' => '/countries-list/australia',
                'New Zealand Casinos' => '/countries-list/new-zealand',
                'Netherlands Casinos' => '/countries-list/netherlands',
                'Sweden Casinos' => '/countries-list/sweden',
                'All Countries' => '/countries '
            ],
        ],

        "BANKING"=>[
            "item_url" =>"/banking",
            "sub_items"=>[
                'Neteller Casinos' =>'/banking/neteller',
                'Skrill Moneybookers Casinos' => '/banking/skrill-moneybookers',
                'PayPal Casinos' => '/banking/paypal',
                'Bitcoin Casinos' => '/banking/bitcoin',
                'EcoPayz EcoCard Casinos' => '/banking/ecopayz-ecocard',
                'Paysafe Card' => '/banking/paysafecard',
                'All Banking' => '/banking'
            ],
        ],
        "GAMES"=>[
            "item_url" =>"/games",
            "sub_items"=>[
                'Video Slots' => '/games/video-slots',
                'Classic Slots' => '/games/classic-slots',
                'Video Poker' => '/games/video-poker',
                'Scratch Cards' => '/games/scratch-cards',
                'Blackjack' => '/games/blackjack',
                'Roulette' => '/games/roulette',
                'Table Games' => '/games/table-games',
                'Bingo' => '/games/bingo',
                'Baccarat' => '/games/baccarat',
                'Craps' => '/games/craps',
                'Keno' => '/games/keno',
                'Other' => '/games/other',
                'All Games' => '/games'
            ],
        ],
        "BLOG"=>[
            "item_url" =>"/blog",
            "sub_items"=>[
                'News' => '/blog/news',
                'Guides' => '/blog/guides',
                'All Blog Articles' => '/blog',
            ],
        ]

    ];
    private $pages = array();

    public function __construct($currentPage, $specific_page = '', $user_country = '')
    {
        $this->userCountry = $user_country;
        $this->setUserCountryInMenu();

        $this->setEntries($currentPage, $specific_page);
    }

    private function setUserCountryInMenu()
    {
        $country_url =   "/countries-list/".strtolower(str_replace(" ", "-", str_replace(["(",")","'"],["","",""], $this->userCountry->name)));
        $countriesUrl = self::$entries['COUNTRIES']['sub_items'];

        $newMenuItem = [];

        if (!in_array($country_url, $countriesUrl)) {
            $country_name = $this->countryMenuNameByUrl($country_url);
            $key = (!empty($country_name) ? $country_name : $this->userCountry->name) .' Casinos';
            $newMenuItem[$key] = $country_url;
            $countriesUrl = array_merge($newMenuItem, $countriesUrl);
            self::$entries['COUNTRIES']['sub_items'] = $countriesUrl;
        }
    }

    /**
     * set special case for the country name, based by url
     */
    private function countryMenuNameByUrl($country_url)
    {
        switch ($country_url) {

            case '/countries-list/united-states':
                return 'US';
                break;

            case '/countries-list/united-kingdom':
                return 'UK';
                break;
        }

        return '';
    }

    private function setEntries($currentPage, $specific_page = '')
    {
        $selectedEntry = $this->getSelectedEntry($currentPage, $specific_page);

        foreach (self::$entries as $title=>$entry_data) {
            $object = new MenuItem();
            $object->title = $title;
            $object->url = $entry_data['item_url'];
            $object->is_active = ($title==$selectedEntry?true:false);

            if (!empty($entry_data["sub_items"])) {
                $object->have_submenu = true;
                foreach ($entry_data["sub_items"] as $subItemTitle => $subItemUrl) {
                    $si = new MenuItem();
                    $si->title = $subItemTitle;
                    $si->url = $subItemUrl;
                    $si->is_active = ("/".$specific_page==$subItemUrl?true:false);
                    $object->submenuItems[] = $si;
                }
            }
            $this->pages[] = $object;
        }
//        var_dump($this->pages);
    }

    private function getSelectedEntry($currentPage, $specificPage = '')
    {
        switch ($currentPage) {
            case "bonus-list/(name)":
                return "NO DEPOSIT CASINOS";
                break;

            case "casinos":
            case "casinos/(name)":
                /*
                 * NEW CASINOS Special case for the same url pattern "casinos/(name).
                 * Should return a specific menu item
                 *
                 */
                if ($specificPage === "casinos/new") {
                    return 'NEW CASINOS';
                    break;
                }

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
                case "banking":
            case "banking/(name)":
                return "BANKING";
                break;
            case "live-dealer/(TYPE)":
            case "features/(name)":
                /*
                    Specific case for features/ecogra-casinos
                */
                if ($specificPage === "features/ecogra-casinos") {
                    return "CASINOS";
                    break;
                }
                return "LIVE";
                break;
            case "games":
            case "games/(type)":
            case "play/(name)":
                return "GAMES";
                break;
            case "blog":
            case "blog/(category)":
            case "(category)/(name)":
                return "BLOG";
                break;
            default:
                return "";
                break;
        }
    }

    public function getEntries()
    {
        return $this->pages;
    }
}
