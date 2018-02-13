<?php
class CasinoInfoController extends Controller {
    public function run() {
        $this->response->setAttribute("country", array (
  'id' => '34',
  'code' => 'US',
  'name' => 'United States',
));
$this->response->setAttribute("casino", array (
  'id' => '29',
  'name' => 'Tropica Casino',
  'rating' => NULL,
  'softwares' => 
  array (
    0 => 'Rival',
  ),
  'languages' => 
  array (
    0 => 'English',
    1 => 'Spanish',
    2 => 'German',
    3 => 'French',
    4 => 'Italian',
  ),
  'currencies' => 
  array (
    0 => 'USD',
    1 => 'EUR',
    2 => 'AUD',
    3 => 'ZAR',
  ),
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
  'is_live_dealer' => '0',
  'date_established' => '2009-09-01',
  'emails' => 
  array (
    0 => 'support@tropicacasino.com',
  ),
  'phones' => 
  array (
    0 => 'General: +1 888-271-9514',
    1 => 'United Kingdom: +44 080-823-47596',
    2 => 'Canada: +1 888-271-9514',
  ),
  'is_live_chat' => '1',
  'licenses' => 
  array (
    0 => 'Curacao',
  ),
  'certifiers' => 
  array (
  ),
  'affiliate_program' => 'Refilliates',
  'affiliate_link' => NULL,
  'withdrawal_minimum' => '$/€/AU$/R25',
  'withdrawal_limits' => 
  array (
    0 => '$/€/AU$/R4000 per week',
  ),
  'withdrawal_timeframes' => 
  array (
    0 => 'Ewallets - 17-21 hours',
    1 => 'Wire Transfer - immediate',
    2 => 'Credit cards - 19-23 business days',
  ),
  'deposit_methods' => 
  array (
    0 => 'EcoPayz EcoCard',
    1 => 'MasterCard',
    2 => 'Neteller',
    3 => 'Paysafe Card',
    4 => 'Skrill Moneybookers',
    5 => 'UseMyServices',
    6 => 'Visa',
    7 => 'Wire Transfer',
    8 => 'Wirecard',
  ),
  'withdraw_methods' => 
  array (
    0 => 'EcoPayz EcoCard',
    1 => 'MasterCard',
    2 => 'Neteller',
    3 => 'Paysafe Card',
    4 => 'Skrill Moneybookers',
    5 => 'UPayCard',
    6 => 'UseMyServices',
    7 => 'Visa',
    8 => 'Wire Transfer',
    9 => 'Wirecard',
  ),
  'is_country_accepted' => '1',
  'is_language_accepted' => '1',
  'is_currency_accepted' => '1',
  'status' => 'Blacklisted',
));
$this->response->setAttribute("total_reviews", 0);
$this->response->setAttribute("reviews", array (
));
$this->response->setAttribute("menu", array (
  '/countries-list/united-states' => 'United States Casinos',
  '/softwares/rival' => 'Rival Casinos',
  '/bonus-list/no-deposit-bonus' => 'No Deposit Casinos',
  '/casinos/best' => 'Best Casinos',
  '/casinos/safe' => 'Safe Casinos',
  '/casinos/new' => 'New Casinos',
  '/casinos/recommended' => 'Recommended Casinos',
  '/casinos/stay-away' => 'Stay Away Casinos',
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

    }
}
        