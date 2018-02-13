<?php
class CasinosByBonusTypeController extends Controller {
    public function run() {
        $this->response->setAttribute("selected_entity", 'No Deposit Bonus');
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
    'is_active' => true,
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
    'title' => 'No Deposit Casinos',
    'url' => '/bonus-list/no-deposit-bonus',
    'is_active' => true,
  ),
  2 => 
  array (
    'title' => 'Best Casinos',
    'url' => '/casinos/best',
    'is_active' => false,
  ),
  3 => 
  array (
    'title' => 'Safe Casinos',
    'url' => '/casinos/safe',
    'is_active' => false,
  ),
  4 => 
  array (
    'title' => 'New Casinos',
    'url' => '/casinos/new',
    'is_active' => false,
  ),
  5 => 
  array (
    'title' => 'Recommended Casinos',
    'url' => '/casinos/recommended',
    'is_active' => false,
  ),
  6 => 
  array (
    'title' => 'Stay Away Casinos',
    'url' => '/casinos/stay-away',
    'is_active' => false,
  ),
));
$this->response->setAttribute("menu", array (
  '/countries-list/united-states' => 'United States Casinos',
  '/bonus-list/no-deposit-bonus' => 'No Deposit Casinos',
  '/casinos/best' => 'Best Casinos',
  '/casinos/safe' => 'Safe Casinos',
  '/casinos/new' => 'New Casinos',
  '/casinos/recommended' => 'Recommended Casinos',
  '/casinos/stay-away' => 'Stay Away Casinos',
));
$this->response->setAttribute("country", array (
  'id' => '34',
  'code' => 'US',
  'name' => 'United States',
));
$this->response->setAttribute("total_casinos", 276);
$this->response->setAttribute("casinos", array (
  0 => 
  array (
    'id' => '29',
    'name' => 'Tropica Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Rival',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '200%',
      'min_deposit' => '$/€/£25',
      'wagering' => '25x(D+B)',
      'games_allowed' => 'All except Keno,Roulette,Craps & Baccarat,Double Up,Red Dog,Sicbo,Progressive Games',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '$/€/£50',
      'min_deposit' => '',
      'wagering' => '60xB',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '2009-09-01',
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
    'id' => '1189',
    'name' => 'Hera Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'RTG',
      1 => 'Yggdrasil Gaming',
      2 => 'Pragmatic Play',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '200%',
      'min_deposit' => '$30',
      'wagering' => '30xD',
      'games_allowed' => 'All',
      'code' => 'TBFCL1ST',
    ),
    'bonus_free' => 
    array (
      'amount' => '$50',
      'min_deposit' => '',
      'wagering' => '50xB',
      'games_allowed' => 'All',
      'code' => 'TBFCLFREE50',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '2016-02-02',
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
    'id' => '1164',
    'name' => 'Aunty Acid Bingo',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'MicroGaming',
      1 => 'Cozy Games',
      2 => 'Eyecon',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '500%',
      'min_deposit' => '$/€/£10',
      'wagering' => '10x(D+B)',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '$/€/£15',
      'min_deposit' => '',
      'wagering' => '10x(D+B)',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '2005-01-01',
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
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
  3 => 
  array (
    'id' => '1090',
    'name' => 'Quackpot Bingo',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Cozy Games',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '500%',
      'min_deposit' => '$/€/£10',
      'wagering' => '20xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '$/€/£10',
      'min_deposit' => '',
      'wagering' => '20xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '0000-00-00',
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
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
  4 => 
  array (
    'id' => '1089',
    'name' => 'Merlin Bingo',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Cozy Games',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '500%',
      'min_deposit' => '$/€/£10',
      'wagering' => '10xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '$/€/£10',
      'min_deposit' => '',
      'wagering' => '20xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '0000-00-00',
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
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
  5 => 
  array (
    'id' => '1087',
    'name' => 'Girly Bingo',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'MicroGaming',
      1 => 'Cozy Games',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '350%',
      'min_deposit' => '$/€/£10',
      'wagering' => '10xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '$/€/£15',
      'min_deposit' => '',
      'wagering' => '10xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '0000-00-00',
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
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
  6 => 
  array (
    'id' => '1085',
    'name' => 'Eat Sleep Bingo',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Cozy Games',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '500%',
      'min_deposit' => '$/€/£10',
      'wagering' => '10xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '$/€/£10',
      'min_deposit' => '',
      'wagering' => '20xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '0000-00-00',
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
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
  7 => 
  array (
    'id' => '1084',
    'name' => 'Viking Winners Bingo',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Cozy Games',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '500%',
      'min_deposit' => '$/€/£10',
      'wagering' => '10xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '$/€/£10',
      'min_deposit' => '',
      'wagering' => '20xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '0000-00-00',
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
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
  8 => 
  array (
    'id' => '1083',
    'name' => 'Time Bingo',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Cozy Games',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '500%',
      'min_deposit' => '£10',
      'wagering' => '10xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '£15',
      'min_deposit' => '',
      'wagering' => '20xB',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '0000-00-00',
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
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
  9 => 
  array (
    'id' => '1082',
    'name' => 'The Prize Finder Bingo',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Cozy Games',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '500%',
      'min_deposit' => '£10',
      'wagering' => '10xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '£10',
      'min_deposit' => '',
      'wagering' => '',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '0000-00-00',
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
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
  10 => 
  array (
    'id' => '1080',
    'name' => 'Champers Bingo',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Cozy Games',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '500%',
      'min_deposit' => '$/€/£10',
      'wagering' => '10xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '$/€/£10',
      'min_deposit' => '',
      'wagering' => '20xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '0000-00-00',
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
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
  11 => 
  array (
    'id' => '1073',
    'name' => 'Naughty Bingo',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Cozy Games',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '500%',
      'min_deposit' => '£10',
      'wagering' => '40xB',
      'games_allowed' => 'Slots & Bingo',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '£15',
      'min_deposit' => '',
      'wagering' => '20xB',
      'games_allowed' => 'Cozy Games',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '0000-00-00',
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
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
  12 => 
  array (
    'id' => '1071',
    'name' => 'Lucky Touch Bingo',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Cozy Games',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '500%',
      'min_deposit' => '$/€/£10',
      'wagering' => '10xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '$/€/£10',
      'min_deposit' => '',
      'wagering' => '10xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '0000-00-00',
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
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
  13 => 
  array (
    'id' => '1045',
    'name' => 'Love My Bingo',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'MicroGaming',
      1 => 'Cozy Games',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '£500',
      'min_deposit' => '£10',
      'wagering' => '10x(D+B)',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '£15',
      'min_deposit' => '',
      'wagering' => '20xB',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '2005-01-01',
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
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
  14 => 
  array (
    'id' => '1042',
    'name' => 'Grimms Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Cozy Games',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '500%',
      'min_deposit' => '$/€/£10',
      'wagering' => '10x(D+B)',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '$/€/£10',
      'min_deposit' => '',
      'wagering' => '20xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '2005-01-01',
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
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
  15 => 
  array (
    'id' => '1026',
    'name' => 'Honey Bees Bingo',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Cozy Games',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '500%',
      'min_deposit' => '$/€/£10',
      'wagering' => '10x(D+B)',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '$/€/£10',
      'min_deposit' => '',
      'wagering' => '20xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '0000-00-00',
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
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
  16 => 
  array (
    'id' => '1025',
    'name' => 'Gravy Train Bingo',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Cozy Games',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '500%',
      'min_deposit' => '£10',
      'wagering' => '10x(D+B)',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '£15',
      'min_deposit' => '',
      'wagering' => '10xB',
      'games_allowed' => 'Bingo',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '0000-00-00',
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
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
  17 => 
  array (
    'id' => '1024',
    'name' => 'Galaxy Bingo',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Cozy Games',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '500%',
      'min_deposit' => '£10',
      'wagering' => '10x(D+B)',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '£5',
      'min_deposit' => '',
      'wagering' => '20xB',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '0000-00-00',
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
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
  18 => 
  array (
    'id' => '1023',
    'name' => 'Comfy Bingo',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Cozy Games',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '500%',
      'min_deposit' => '£10',
      'wagering' => '10x(D+B)',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '£15',
      'min_deposit' => '',
      'wagering' => '10xB',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '0000-00-00',
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
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
  19 => 
  array (
    'id' => '1022',
    'name' => 'Mummies Bingo',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Cozy Games',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '500%',
      'min_deposit' => '£10',
      'wagering' => '10xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '£10',
      'min_deposit' => '',
      'wagering' => '20xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '0000-00-00',
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
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
));

    }
}
        