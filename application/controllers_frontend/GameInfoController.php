<?php
class GameInfoController extends Controller {
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
    'is_active' => true,
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
$this->response->setAttribute("game_types", array (
  0 => 'Video Slots',
  1 => 'Video Poker',
  2 => 'Classic Slots',
  3 => 'Scratch Cards',
  4 => 'Blackjack',
  5 => 'Other',
  6 => 'Roulette',
  7 => 'Table Games',
  8 => 'Keno',
  9 => 'Baccarat',
  10 => 'Bingo',
  11 => 'Craps',
));
$this->response->setAttribute("game", array (
  'id' => '7268',
  'name' => 'Exotic Fruit Deluxe',
  'type' => 'Video Slots',
  'software' => 'Booming Games',
  'release_date' => '2018-11-03',
  'technologies' => 
  array (
    0 => 'HTML5',
  ),
  'is_mobile' => true,
  'is_3d' => NULL,
  'overview' => NULL,
  'times_played' => '59',
  'play' => NULL,
));
$this->response->setAttribute("game_player", array (
  'url' => 'https://devgame.casinoslists.com',
  'width' => '960',
  'height' => '720',
));
$this->response->setAttribute("recommended_casinos", array (
  0 => 
  array (
    'id' => '1195',
    'name' => 'Smashing Casino',
    'code' => 'smashing_casino',
    'rating' => 10,
    'softwares' => 
    array (
      0 => 'BetSoft',
      1 => 'Spinomenal',
      2 => 'Booming Games',
      3 => 'GameArt',
      4 => 'Playson',
      5 => 'GameScale',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '300% + 50 FS',
      'min_deposit' => '€/£20',
      'wagering' => '33x(D+B)',
      'games_allowed' => 'All Betsoft Games',
      'code' => 'SMASH50',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => 
    array (
      'amount' => '€5',
      'min_deposit' => '',
      'wagering' => '99xB',
      'games_allowed' => 'Betsoft Slots',
      'code' => 'No code required',
      'type' => 'No Deposit Bonus',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '2017-06-05',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '1',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'invision_casino_id' => NULL,
    'date_formatted' => 'Jun. 05, 2017',
    'status' => '0',
  ),
  1 => 
  array (
    'id' => '1173',
    'name' => 'Casino Superlines',
    'code' => 'casino_superlines',
    'rating' => 5,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'Nektan',
      2 => 'BetSoft',
      3 => 'NextGen Gaming',
      4 => 'Leander Games',
      5 => 'GameScale',
      6 => '1X2 Gaming',
      7 => 'Air Dice',
      8 => 'Spinomenal',
      9 => 'Lightning Box Games',
      10 => 'Booming Games',
      11 => 'GameArt',
      12 => 'ELK Studios',
      13 => 'Playson',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '400%',
      'min_deposit' => '€20',
      'wagering' => '30x(D+B)',
      'games_allowed' => 'All',
      'code' => 'No code required',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => 
    array (
      'amount' => '€10',
      'min_deposit' => '',
      'wagering' => '60xB',
      'games_allowed' => 'Slots & Scratch Cards',
      'code' => 'CASINOSLISTS10',
      'type' => 'No Deposit Bonus',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '2017-04-01',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '1',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'invision_casino_id' => NULL,
    'date_formatted' => 'Apr. 01, 2017',
    'status' => '0',
  ),
  2 => 
  array (
    'id' => '1069',
    'name' => 'CompanyCasino',
    'code' => 'company_casino',
    'rating' => 6,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'Spinomenal',
      2 => 'Lightning Box Games',
      3 => 'Booming Games',
      4 => 'GameArt',
      5 => 'ELK Studios',
      6 => 'Playson',
      7 => '1X2 Gaming',
      8 => 'Thunderkick',
      9 => 'GameScale',
      10 => 'Leander Games',
      11 => 'Amaya Gaming',
      12 => 'Nektan',
      13 => 'BetSoft',
      14 => 'NextGen Gaming',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '200%',
      'min_deposit' => '€20',
      'wagering' => '33x(D+B)',
      'games_allowed' => 'All',
      'code' => 'No code required',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => 
    array (
      'amount' => '€7',
      'min_deposit' => '',
      'wagering' => '99xB',
      'games_allowed' => 'All',
      'code' => '7FREE',
      'type' => 'No Deposit Bonus',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '2016-11-01',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '1',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'invision_casino_id' => NULL,
    'date_formatted' => 'Nov. 01, 2016',
    'status' => '0',
  ),
  3 => 
  array (
    'id' => '963',
    'name' => 'Cashpot Casino',
    'code' => 'cashpot_casino',
    'rating' => 9,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'BetSoft',
      2 => 'NextGen Gaming',
      3 => 'Amaya Gaming',
      4 => 'GameScale',
      5 => 'Spinomenal',
      6 => 'Lightning Box Games',
      7 => 'Booming Games',
      8 => 'ELK Studios',
      9 => 'Playson',
      10 => '1X2 Gaming',
      11 => 'Thunderkick',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '300% + 50 FS',
      'min_deposit' => '€20',
      'wagering' => '33x(D+B)',
      'games_allowed' => 'All (FS - BetSoft Games)',
      'code' => 'CASINOSLISTS1ST',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => 
    array (
      'amount' => '€7',
      'min_deposit' => '',
      'wagering' => '99xB',
      'games_allowed' => 'All',
      'code' => '7CASH',
      'type' => 'No Deposit Bonus',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '2016-08-04',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '1',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'invision_casino_id' => NULL,
    'date_formatted' => 'Aug. 04, 2016',
    'status' => '0',
  ),
  4 => 
  array (
    'id' => '954',
    'name' => 'Africasino',
    'code' => 'afri_casino',
    'rating' => 9,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'NextGen Gaming',
      2 => 'Spinomenal',
      3 => 'Lightning Box Games',
      4 => 'Booming Games',
      5 => 'GameArt',
      6 => 'ELK Studios',
      7 => 'Playson',
      8 => '1X2 Gaming',
      9 => 'GameScale',
      10 => 'Amaya Gaming',
      11 => 'BetSoft',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '300%',
      'min_deposit' => '50 ZAR',
      'wagering' => '30x(D+B)',
      'games_allowed' => 'All',
      'code' => 'No code required',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => 
    array (
      'amount' => '77 ZAR',
      'min_deposit' => '',
      'wagering' => '99xB',
      'games_allowed' => 'Slots',
      'code' => 'CASINOSLISTS77',
      'type' => 'No Deposit Bonus',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '2017-01-01',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '1',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'invision_casino_id' => NULL,
    'date_formatted' => 'Jan. 01, 2017',
    'status' => '0',
  ),
));
$this->response->setAttribute("is_mobile", false);
$this->response->setAttribute("recommended_games", array (
  7268 => 
  array (
    'id' => '7268',
    'name' => 'Exotic Fruit Deluxe',
    'type' => NULL,
    'software' => 'Booming Games',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '59',
    'play' => NULL,
  ),
  7263 => 
  array (
    'id' => '7263',
    'name' => 'Goddess of the Amazon',
    'type' => NULL,
    'software' => 'Inspired',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7262 => 
  array (
    'id' => '7262',
    'name' => 'Inspired Centurion',
    'type' => NULL,
    'software' => 'Inspired',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7261 => 
  array (
    'id' => '7261',
    'name' => 'White Knight',
    'type' => NULL,
    'software' => 'Inspired',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7260 => 
  array (
    'id' => '7260',
    'name' => 'Inspired Monster Cash',
    'type' => NULL,
    'software' => 'Inspired',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7259 => 
  array (
    'id' => '7259',
    'name' => 'Inspired Diamond Goddess',
    'type' => NULL,
    'software' => 'Inspired',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
));
$this->response->setAttribute("menu_bottom", array (
  0 => 
  array (
    'title' => 'Video Slots',
    'url' => '/games/video-slots',
    'is_active' => true,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  1 => 
  array (
    'title' => 'Video Poker',
    'url' => '/games/video-poker',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  2 => 
  array (
    'title' => 'Classic Slots',
    'url' => '/games/classic-slots',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  3 => 
  array (
    'title' => 'Scratch Cards',
    'url' => '/games/scratch-cards',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  4 => 
  array (
    'title' => 'Blackjack',
    'url' => '/games/blackjack',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  5 => 
  array (
    'title' => 'Other',
    'url' => '/games/other',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  6 => 
  array (
    'title' => 'Roulette',
    'url' => '/games/roulette',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  7 => 
  array (
    'title' => 'Table Games',
    'url' => '/games/table-games',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  8 => 
  array (
    'title' => 'Keno',
    'url' => '/games/keno',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  9 => 
  array (
    'title' => 'Baccarat',
    'url' => '/games/baccarat',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  10 => 
  array (
    'title' => 'Bingo',
    'url' => '/games/bingo',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  11 => 
  array (
    'title' => 'Craps',
    'url' => '/games/craps',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
));
$this->response->setAttribute("page_info", array (
  'head_title' => 'Play Exotic Fruit Deluxe for Fun at CasinosLists.com',
  'head_description' => 'Free Play Exotic Fruit Deluxe | Exotic Fruit Deluxe Demo Game, No Registration Required, Play the Game Exotic Fruit Deluxe at CasinosLists.com - 2018',
  'body_title' => 'Exotic Fruit Deluxe',
));
$this->response->setAttribute("version", '0.8.3.7');
$this->response->setAttribute("tms", array (
));

    }
}
        