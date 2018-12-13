<?php
class PageNotFoundController extends Controller {
    public function run() {
        $this->response->setAttribute("country", array (
  'id' => '43',
  'code' => 'RO',
  'name' => 'Romania',
));
$this->response->setAttribute("menu_top", array (
  0 => 
  array (
    'title' => 'NO DEPOSIT CASINOS',
    'url' => '/bonus-list/no-deposit-bonus',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  1 => 
  array (
    'title' => 'NEW CASINOS',
    'url' => '/casinos/new',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  2 => 
  array (
    'title' => 'CASINOS',
    'url' => '/casinos',
    'is_active' => false,
    'submenuItems' => 
    array (
      'Best Casinos' => '/casinos/best',
      'Live Casinos' => '/features/live-dealer',
      'Mobile Casinos' => '/casinos/mobile',
      'eCOGRA Casinos' => '/features/ecogra-casinos',
      'Stay Away Casinos' => '/casinos/stay-away',
      'Popular Casinos' => '/casinos/popular',
      'All Casinos' => '/casinos',
    ),
    'have_submenu' => true,
  ),
  3 => 
  array (
    'title' => 'SOFTWARES',
    'url' => '/softwares',
    'is_active' => false,
    'submenuItems' => 
    array (
      'RTG Casinos' => '/softwares/rtg',
      'Rival Casinos' => '/softwares/rival',
      'NetEnt Casinos' => '/softwares/netent',
      'Playtech Casinos' => '/softwares/playtech',
      'MicroGaming Casinos' => '/softwares/microgaming',
      'BetSoft Casinos' => '/softwares/betsoft',
      'Saucify Casinos' => '/softwares/saucify',
      'Cryptologic Casinos' => '/softwares/cryptologic',
      'All Softwares' => '/softwares',
    ),
    'have_submenu' => true,
  ),
  4 => 
  array (
    'title' => 'COUNTRIES',
    'url' => '/countries',
    'is_active' => false,
    'submenuItems' => 
    array (
      'Romania Casinos' => '/countries-list/romania',
      'USA Casinos' => '/countries-list/united-states',
      'UK Casinos' => '/countries-list/united-kingdom',
      'Australia Casinos' => '/countries-list/australia',
      'Germany Casinos' => '/countries-list/germany',
      'New Zealand Casinos' => '/countries-list/new-zealand',
      'Netherlands Casinos' => '/countries-list/netherlands',
      'Sweden Casinos' => '/countries-list/sweden',
      'All Countries' => '/countries ',
    ),
    'have_submenu' => true,
  ),
  5 => 
  array (
    'title' => 'BANKING',
    'url' => '/banking',
    'is_active' => false,
    'submenuItems' => 
    array (
      'Neteller Casinos' => '/banking/neteller',
      'Skrill Moneybookers Casinos' => '/banking/skrill-moneybookers',
      'PayPal Casinos' => '/banking/paypal',
      'Bitcoin Wallets Casinos' => '/banking/bitcoin-wallets',
      'EcoPayz EcoCard Casinos' => '/banking/ecopayz',
      'Paysafe Card' => '/banking/paysafe-card',
      'All Banking' => '/banking',
    ),
    'have_submenu' => true,
  ),
  6 => 
  array (
    'title' => 'GAMES',
    'url' => '/games',
    'is_active' => false,
    'submenuItems' => 
    array (
      'Video Slots' => '/games/video-slots',
      'Classic Slots' => '/games/slots',
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
      'All Games' => '/games',
    ),
    'have_submenu' => true,
  ),
));
$this->response->setAttribute("page_info", array (
  'head_title' => 'CasinosLists.com 404 Not Found',
  'head_description' => '',
  'body_title' => '',
));
$this->response->setAttribute("version", '0.8.3.7');
$this->response->setAttribute("tms", array (
));

    }
}
        