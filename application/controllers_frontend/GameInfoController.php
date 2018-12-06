<?php
class GameInfoController extends Controller {
    public function run() {
        $this->response->setAttribute("country", array (
  'id' => '34',
  'code' => 'US',
  'name' => 'United States',
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
  9 => 'Bingo',
  10 => 'Baccarat',
  11 => 'Craps',
));
$this->response->setAttribute("game", array (
  'id' => '6966',
  'name' => 'Planet Fortune',
  'type' => 'Video Slots',
  'software' => 'Play n GO',
  'release_date' => '2018-01-25',
  'technologies' => 
  array (
    0 => 'HTML5',
    1 => 'Flash',
  ),
  'is_mobile' => true,
  'is_3d' => true,
  'overview' => NULL,
  'times_played' => '0',
  'play' => 
  array (
    'width' => '960',
    'height' => '720',
    'screenshot' => '/public/img/sync/game_ss/960x720/Planet_Fortune_ss.jpg',
    'url' => 'http://showcase.playngo.com/Casino/PlayFlash?pid=2&gid=planetfortune',
    'status' => 'redirect',
  ),
));
$this->response->setAttribute("recommended_casinos", array (
  0 => 
  array (
    'id' => '257',
    'code' => 'Jackpot Capital',
    'name' => 'Jackpot Capital',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'RTG',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '150% + 20 FS',
      'min_deposit' => '$20',
      'wagering' => '30x(D+B)',
      'games_allowed' => 'All (FS - Ninja Star)',
      'code' => 'BIGFREECHIPLIST300',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => 
    array (
      'amount' => '$25',
      'min_deposit' => '',
      'wagering' => '60xB',
      'games_allowed' => 'Slots,Keno & 7 Stud Poker,Pai Gow Poker',
      'code' => 'THEBIGFREECHIPLIST',
      'type' => 'No Deposit Bonus',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '2008-01-01',
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
  ),
  1 => 
  array (
    'id' => '878',
    'code' => 'Jackpot Capital',
    'name' => 'Stake7 Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Merkur Gaming',
      1 => 'Blueprint Gaming',
      2 => 'Bally',
      3 => 'Scientific Games',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100%',
      'min_deposit' => '€10',
      'wagering' => '24x(D+B)',
      'games_allowed' => 'All',
      'code' => 'FD100',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2013-07-01',
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
  ),
  2 => 
  array (
    'id' => '785',
    'code' => 'Jackpot Capital',
    'name' => 'VegasCasino.io',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'BetSoft',
      1 => 'Quickspin',
      2 => 'Ezugi',
      3 => 'Play n GO',
      4 => 'Endorphina',
      5 => 'GameArt',
      6 => 'Booming Games',
      7 => 'Pragmatic Play',
      8 => 'BetGames',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '150%',
      'min_deposit' => '0.001 ........ .... .. . BTC.',
      'wagering' => '35xB',
      'games_allowed' => 'All',
      'code' => 'WELCOME150',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2014-12-01',
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
  ),
  3 => 
  array (
    'id' => '340',
    'code' => 'Jackpot Capital',
    'name' => 'Exclusive Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'RTG',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '250%',
      'min_deposit' => '$/€30',
      'wagering' => '0',
      'games_allowed' => 'Slots & Keno',
      'code' => 'TBFCL250',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => 
    array (
      'amount' => '50',
      'min_deposit' => '',
      'wagering' => '30xB',
      'games_allowed' => 'All except Roulette,Craps & Baccarat,Sic Bo,War,Pai-Gow Poker',
      'code' => 'TBFCL50S',
      'type' => 'Free Spins',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '2012-01-01',
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
  ),
  4 => 
  array (
    'id' => '1171',
    'code' => 'Jackpot Capital',
    'name' => '1xBit Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'Evolution Gaming',
      2 => 'Novomatic',
      3 => 'Playtech',
      4 => 'BetSoft',
      5 => 'EGT',
      6 => 'IGT',
      7 => 'Aristocrat',
      8 => 'Amatic Industries',
      9 => 'Pragmatic Play',
      10 => 'XPG',
      11 => 'Ezugi',
      12 => 'Tom Horn',
      13 => 'Playson',
      14 => 'Igrosoft',
      15 => 'Play n GO',
      16 => 'Endorphina',
      17 => 'GameArt',
      18 => 'MicroGaming',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100%',
      'min_deposit' => '0.005 BTC',
      'wagering' => '5xB',
      'games_allowed' => 'All',
      'code' => 'No code required',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2007-09-01',
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
  ),
));
$this->response->setAttribute("recommended_games", array (
  6966 => 
  array (
    'id' => '6966',
    'name' => 'Planet Fortune',
    'type' => NULL,
    'software' => 'Play n GO',
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
  6965 => 
  array (
    'id' => '6965',
    'name' => 'Mighty Arthur',
    'type' => NULL,
    'software' => 'Quickspin',
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
  6964 => 
  array (
    'id' => '6964',
    'name' => 'Pied Piper',
    'type' => NULL,
    'software' => 'Quickspin',
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
  6962 => 
  array (
    'id' => '6962',
    'name' => 'Rapunzels Tower',
    'type' => NULL,
    'software' => 'Quickspin',
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
  6961 => 
  array (
    'id' => '6961',
    'name' => 'Grill King',
    'type' => NULL,
    'software' => 'Fugaso',
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
  6960 => 
  array (
    'id' => '6960',
    'name' => 'Gates of Hell',
    'type' => NULL,
    'software' => 'Fugaso',
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
$this->response->setAttribute("menu_top", array (
  0 => 
  array (
    'title' => 'CASINOS',
    'url' => '/casinos',
    'is_active' => false,
  ),
  1 => 
  array (
    'title' => 'SOFTWARES',
    'url' => '/softwares',
    'is_active' => false,
  ),
  2 => 
  array (
    'title' => 'BONUSES',
    'url' => '/bonus-list',
    'is_active' => false,
  ),
  3 => 
  array (
    'title' => 'COUNTRIES',
    'url' => '/countries',
    'is_active' => false,
  ),
  4 => 
  array (
    'title' => 'COMPATIBILITY',
    'url' => '/compatability',
    'is_active' => false,
  ),
  5 => 
  array (
    'title' => 'BANKING',
    'url' => '/banking',
    'is_active' => false,
  ),
  6 => 
  array (
    'title' => 'FEATURES',
    'url' => '/features',
    'is_active' => false,
  ),
  7 => 
  array (
    'title' => 'GAMES',
    'url' => '/games',
    'is_active' => true,
  ),
));
$this->response->setAttribute("menu_bottom", array (
  0 => 
  array (
    'title' => 'Video Slots',
    'url' => '/games/video-slots',
    'is_active' => true,
  ),
  1 => 
  array (
    'title' => 'Video Poker',
    'url' => '/games/video-poker',
    'is_active' => false,
  ),
  2 => 
  array (
    'title' => 'Classic Slots',
    'url' => '/games/classic-slots',
    'is_active' => false,
  ),
  3 => 
  array (
    'title' => 'Scratch Cards',
    'url' => '/games/scratch-cards',
    'is_active' => false,
  ),
  4 => 
  array (
    'title' => 'Blackjack',
    'url' => '/games/blackjack',
    'is_active' => false,
  ),
  5 => 
  array (
    'title' => 'Other',
    'url' => '/games/other',
    'is_active' => false,
  ),
  6 => 
  array (
    'title' => 'Roulette',
    'url' => '/games/roulette',
    'is_active' => false,
  ),
  7 => 
  array (
    'title' => 'Table Games',
    'url' => '/games/table-games',
    'is_active' => false,
  ),
  8 => 
  array (
    'title' => 'Keno',
    'url' => '/games/keno',
    'is_active' => false,
  ),
  9 => 
  array (
    'title' => 'Bingo',
    'url' => '/games/bingo',
    'is_active' => false,
  ),
  10 => 
  array (
    'title' => 'Baccarat',
    'url' => '/games/baccarat',
    'is_active' => false,
  ),
  11 => 
  array (
    'title' => 'Craps',
    'url' => '/games/craps',
    'is_active' => false,
  ),
));
$this->response->setAttribute("page_info", array (
  'head_title' => 'Play Planet Fortune for Fun at CasinosLists.com',
  'head_description' => 'Free Play Planet Fortune | Planet Fortune Demo Game, No Registration Required, Play the Game Planet Fortune at CasinosLists.com - 2018',
  'body_title' => 'Planet Fortune',
));
$this->response->setAttribute("is_mobile", NULL);

    }
}
        