<?php
class CasinoWarningController extends Controller {
    public function run() {
        $this->response->setAttribute("country", array (
  'id' => '34',
  'code' => 'US',
  'name' => 'United States',
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
    'is_active' => false,
  ),
));
$this->response->setAttribute("casino", array (
  'id' => '29',
  'name' => 'Tropica Casino',
  'rating' => NULL,
  'softwares' => 'Rival',
  'languages' => NULL,
  'currencies' => NULL,
  'bonus_first_deposit' => NULL,
  'bonus_free' => NULL,
  'is_live_dealer' => NULL,
  'date_established' => NULL,
  'emails' => NULL,
  'phones' => NULL,
  'is_live_chat' => NULL,
  'licenses' => NULL,
  'certifiers' => NULL,
  'affiliate_program' => NULL,
  'affiliate_link' => 'http://tropicacasino.com/get/a/4149589',
  'withdrawal_minimum' => NULL,
  'withdrawal_limits' => NULL,
  'withdrawal_timeframes' => NULL,
  'deposit_methods' => NULL,
  'withdraw_methods' => NULL,
  'is_country_accepted' => NULL,
  'is_language_accepted' => NULL,
  'is_currency_accepted' => NULL,
  'status' => 'Blacklisted',
  'is_open' => '1',
));
$this->response->setAttribute("recommended_casinos", array (
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
    'id' => '988',
    'name' => 'OG Palace Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Rival',
      1 => 'BetSoft',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '150%',
      'min_deposit' => '$/€/£25',
      'wagering' => '30x(D+B)',
      'games_allowed' => 'All except Progressives,Gameset,Doubleup',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '33 FS',
      'min_deposit' => '',
      'wagering' => '35xB',
      'games_allowed' => 'Windy Farm Slot',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '2010-01-01',
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
    'id' => '962',
    'name' => 'Gibson Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Rival',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '400%',
      'min_deposit' => '$/€/£25',
      'wagering' => '35x(D+B)',
      'games_allowed' => 'Roulette,Craps,All except Baccarat,DoubleUp,RedDog,Sicbo & Slot Progressive.',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '$/€/£25',
      'min_deposit' => '',
      'wagering' => '60xB',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '2014-07-01',
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
    'id' => '755',
    'name' => 'Vegas2Web Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Rival',
      1 => 'BetSoft',
      2 => 'Vivo Gaming',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '150% + 25 FS',
      'min_deposit' => '$/€25',
      'wagering' => '30x(D+B)',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '$/€20',
      'min_deposit' => '',
      'wagering' => '40xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '2010-01-01',
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
    'id' => '596',
    'name' => 'Vortex Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Rival',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '300%',
      'min_deposit' => '$/€/£25',
      'wagering' => '30x(D+B)',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'bonus_free' => 
    array (
      'amount' => '$/€/£15',
      'min_deposit' => '',
      'wagering' => '40xB',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '2014-07-01',
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
$this->response->setAttribute("menu_bottom", array (
  0 => 
  array (
    'title' => 'United States Casinos',
    'url' => '/countries-list/united-states',
    'is_active' => false,
  ),
  1 => 
  array (
    'title' => 'Rival Casinos',
    'url' => '/softwares/rival',
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
$this->response->setAttribute("page_info", array (
  'head_title' => 'Hold Your Horses! Important message regarding Tropica Casino',
  'head_description' => 'Stop! Important message regarding Tropica Casino',
  'body_title' => 'Tropica Casino Note',
));

    }
}
        