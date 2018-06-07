<?php
class CasinosByLabelController extends Controller {
    public function run() {
        $this->response->setAttribute("selected_entity", 'Live Dealer');
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
    'is_active' => true,
  ),
  7 => 
  array (
    'title' => 'GAMES',
    'url' => '/games',
    'is_active' => false,
  ),
));
$this->response->setAttribute("menu_bottom", array (
  0 => 
  array (
    'title' => 'United States Casinos',
    'url' => '/countries-list/united-states',
    'is_active' => false,
  ),
  1 => 
  array (
    'title' => 'Live Dealer Casinos',
    'url' => '/features/live-dealer',
    'is_active' => true,
  ),
  2 => 
  array (
    'title' => 'No Deposit Casinos',
    'url' => '/bonus-list/no-deposit-bonus',
    'is_active' => false,
  ),
  3 => 
  array (
    'title' => 'Best Casinos',
    'url' => '/casinos/best',
    'is_active' => false,
  ),
  4 => 
  array (
    'title' => 'Safe Casinos',
    'url' => '/casinos/safe',
    'is_active' => false,
  ),
  5 => 
  array (
    'title' => 'New Casinos',
    'url' => '/casinos/new',
    'is_active' => false,
  ),
  6 => 
  array (
    'title' => 'Recommended Casinos',
    'url' => '/casinos/recommended',
    'is_active' => false,
  ),
  7 => 
  array (
    'title' => 'Stay Away Casinos',
    'url' => '/casinos/stay-away',
    'is_active' => false,
  ),
));
$this->response->setAttribute("country", array (
  'id' => '34',
  'code' => 'US',
  'name' => 'United States',
));
$this->response->setAttribute("total_casinos", 512);
$this->response->setAttribute("casinos", array (
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
  5 => 
  array (
    'id' => '1124',
    'code' => 'Jackpot Capital',
    'name' => 'Bet East Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Ezugi',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '200%',
      'min_deposit' => '$/€/£10',
      'wagering' => '35x(D+B)',
      'games_allowed' => 'All except BlackJack,Roulette and Table Games',
      'code' => '200FIRST',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2016-01-01',
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
  6 => 
  array (
    'id' => '1091',
    'code' => 'Jackpot Capital',
    'name' => 'Bitcoin Penguin Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'SoftSwiss',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100%',
      'min_deposit' => '0.1 BTC',
      'wagering' => '35x(D+B)',
      'games_allowed' => 'All',
      'code' => 'No code required',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2014-06-17',
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
  7 => 
  array (
    'id' => '1065',
    'code' => 'Jackpot Capital',
    'name' => 'Betive Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'NextGen Gaming',
      2 => 'MicroGaming',
      3 => 'iSoftBet',
      4 => 'Evolution Gaming',
      5 => 'Quickspin',
      6 => 'Quickfire',
      7 => 'ELK Studios',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100%',
      'min_deposit' => '€10',
      'wagering' => '45xB',
      'games_allowed' => 'All',
      'code' => 'No code required',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => 
    array (
      'amount' => '20',
      'min_deposit' => '',
      'wagering' => '45xB',
      'games_allowed' => 'Starbust,Aloha! Cluster Pays,Pyramid: Quest for Immortality,Attraction,Lights',
      'code' => 'No code required',
      'type' => 'Free Spins',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '2016-07-01',
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
  8 => 
  array (
    'id' => '1064',
    'code' => 'Jackpot Capital',
    'name' => 'HRwager Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'SoftSwiss',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '500%',
      'min_deposit' => '$0100',
      'wagering' => '35x(D+B)',
      'games_allowed' => 'All except Craps,Roulette and Dice Games',
      'code' => 'WELCOME500',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2012-12-01',
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
  9 => 
  array (
    'id' => '1039',
    'code' => 'Jackpot Capital',
    'name' => 'Planet Kings Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Rival',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '333%',
      'min_deposit' => '$/€/£25',
      'wagering' => '30x(D+B)',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => 
    array (
      'amount' => '$/€/£33',
      'min_deposit' => '',
      'wagering' => '50xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
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
  ),
));
$this->response->setAttribute("page_info", array (
  'head_title' => 'Live Dealer Casinos List | Find All Live Dealer  Casinos - 2018',
  'head_description' => 'Live Dealer Online Casinos List | Choose a Live Dealer Casino to Play at! CasinosLists.com - 2018',
  'body_title' => 'Live Dealer List',
));

$this->response->setAttribute("is_mobile", NULL);

    }
}
        