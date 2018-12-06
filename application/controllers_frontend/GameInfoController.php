<?php
class GameInfoController extends Controller {
    public function run() {
        $this->response->setAttribute("country", array (
  'id' => '34',
  'code' => 'US',
  'name' => 'United States',
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
  'id' => '6873',
  'name' => 'Divine Fortune',
  'type' => 'Video Slots',
  'software' => 'NetEnt',
  'release_date' => '2016-12-12',
  'technologies' => 
  array (
    0 => 'HTML5',
  ),
  'is_mobile' => true,
  'is_3d' => true,
  'overview' => NULL,
  'times_played' => '0',
  'play' => NULL,
));
$this->response->setAttribute("game_player", array (
  'url' => 'http://game.casinoslists.local',
  'width' => '960',
  'height' => '720',
));
$this->response->setAttribute("recommended_casinos", array (
  0 => 
  array (
    'id' => '1371',
    'name' => 'Casino 5plusbet5',
    'code' => 'casino_5plusbet5',
    'rating' => 1,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'Cryptologic',
      2 => 'NextGen Gaming',
      3 => 'Multislot',
      4 => 'Booming Games',
      5 => 'Patagonia Entertainment',
      6 => 'MrSlotty Games',
      7 => 'Casino Technology',
      8 => 'Join Games',
      9 => 'Iron Dog Studio',
      10 => 'BetGames',
      11 => 'Zeus Services',
      12 => 'BetConstruct',
      13 => 'Pragmatic Play',
      14 => '1X2 Gaming',
      15 => 'Genii',
      16 => 'Pariplay',
      17 => 'GameArt',
      18 => 'Genesis Gaming',
      19 => 'ELK Studios',
      20 => 'Endorphina',
      21 => 'Playson',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '200%',
      'min_deposit' => '$5',
      'wagering' => '20xB',
      'games_allowed' => 'All',
      'code' => 'No code required',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2012-04-27',
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
    'date_formatted' => 'Apr. 27, 2012',
    'status' => '0',
  ),
  1 => 
  array (
    'id' => '1296',
    'name' => 'Wild Tornado Casino',
    'code' => 'wild_tornado_casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'Thunderkick',
      2 => 'Ainsworth',
      3 => 'Amatic Industries',
      4 => 'Belatra Games',
      5 => 'ELK Studios',
      6 => 'SoftSwiss',
      7 => 'Endorphina',
      8 => 'Yggdrasil Gaming',
      9 => 'Amaya Gaming',
      10 => 'BetSoft',
      11 => 'NextGen Gaming',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100% + 250 FS',
      'min_deposit' => '50',
      'wagering' => '40xB',
      'games_allowed' => 'Slots, Keno, Bingo and Scratch Cards (FS - All slots except Jackpot games)',
      'code' => 'No code required',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2017-10-01',
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
    'date_formatted' => 'Oct. 01, 2017',
    'status' => '0',
  ),
  2 => 
  array (
    'id' => '724',
    'name' => 'Sapphire Rooms Casino',
    'code' => 'sapphire_rooms_casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'MicroGaming',
      1 => 'NetEnt',
      2 => 'Nektan',
      3 => 'NextGen Gaming',
      4 => 'NYX Interactive',
      5 => 'IGT',
      6 => 'Felt Gaming',
      7 => 'Iron Dog Studio',
      8 => 'Gamevy',
      9 => 'Scientific Games',
      10 => 'Lightning Box Games',
      11 => 'Realistic Games',
      12 => 'Blueprint Gaming',
      13 => 'Big Time Gaming',
      14 => 'ELK Studios',
      15 => 'Aristocrat',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '200% ',
      'min_deposit' => '€/£10',
      'wagering' => '30x(D+B)',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2014-11-10',
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
    'date_formatted' => 'Nov. 10, 2014',
    'status' => '0',
  ),
  3 => 
  array (
    'id' => '629',
    'name' => 'Chomp Casino',
    'code' => 'chomp_casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'MicroGaming',
      1 => 'Realistic Games',
      2 => 'Iron Dog Studio',
      3 => 'Felt Gaming',
      4 => 'Gamevy',
      5 => 'Scientific Games',
      6 => 'Lightning Box Games',
      7 => 'Blueprint Gaming',
      8 => 'Big Time Gaming',
      9 => 'ELK Studios',
      10 => 'Aristocrat',
      11 => 'IGT',
      12 => 'NetEnt',
      13 => 'Nektan',
      14 => 'NextGen Gaming',
      15 => 'NYX Interactive',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100% + 50 FS',
      'min_deposit' => '£10',
      'wagering' => '30x(D+B)',
      'games_allowed' => 'All ( FS - Starbust)',
      'code' => 'No code required',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2014-04-14',
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
    'date_formatted' => 'Apr. 14, 2014',
    'status' => '0',
  ),
  4 => 
  array (
    'id' => '1293',
    'name' => 'Power Spins Casino',
    'code' => 'power_spins_casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Playtech',
      1 => 'Geco Gaming',
      2 => 'Virtue Fusion',
      3 => 'Lightning Box Games',
      4 => 'Quickspin',
      5 => 'WMS Gaming',
      6 => 'IGT',
      7 => 'NetEnt',
      8 => 'iSoftBet',
      9 => 'NextGen Gaming',
      10 => 'NYX Interactive',
      11 => 'Ash Gaming',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '50 FS',
      'min_deposit' => '£50',
      'wagering' => '0',
      'games_allowed' => 'Robocop, Wild beats, Jungle Trouble and Tiki Paradise',
      'code' => 'No code required',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2016-12-01',
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
    'date_formatted' => 'Dec. 01, 2016',
    'status' => '0',
  ),
));
$this->response->setAttribute("is_mobile", false);
$this->response->setAttribute("recommended_games", array (
  6873 => 
  array (
    'id' => '6873',
    'name' => 'Divine Fortune',
    'type' => NULL,
    'software' => 'NetEnt',
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
  6872 => 
  array (
    'id' => '6872',
    'name' => 'UFC',
    'type' => NULL,
    'software' => 'Endemol Games',
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
  6871 => 
  array (
    'id' => '6871',
    'name' => 'Hulkamania',
    'type' => NULL,
    'software' => 'Endemol Games',
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
  6865 => 
  array (
    'id' => '6865',
    'name' => 'Planet of the Apes',
    'type' => NULL,
    'software' => 'NetEnt',
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
  6864 => 
  array (
    'id' => '6864',
    'name' => 'Emoji Planet',
    'type' => NULL,
    'software' => 'NetEnt',
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
  6863 => 
  array (
    'id' => '6863',
    'name' => 'Wolf Cub',
    'type' => NULL,
    'software' => 'NetEnt',
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
  'head_title' => 'Play Divine Fortune for Fun at CasinosLists.com',
  'head_description' => 'Free Play Divine Fortune | Divine Fortune Demo Game, No Registration Required, Play the Game Divine Fortune at CasinosLists.com - 2018',
  'body_title' => 'Divine Fortune',
));
$this->response->setAttribute("version", '0.8.3.6');
$this->response->setAttribute("tms", array (
));

    }
}
        