<?php
class CasinoInfoController extends Controller {
    public function run() {
        $this->response->setAttribute("country", array (
  'id' => '34',
  'code' => 'US',
  'name' => 'United States',
));
$this->response->setAttribute("casino", array (
  'id' => '1334',
  'name' => '24VIP Casino',
  'rating' => NULL,
  'softwares' => 
  array (
    0 => 'BetSoft',
    1 => 'Rival',
    2 => 'Vivo Gaming',
  ),
  'languages' => 
  array (
    0 => 'English',
    1 => 'Spanish',
    2 => 'German',
    3 => 'Swedish',
    4 => 'Portuguese',
    5 => 'French',
    6 => 'Italian',
  ),
  'currencies' => 
  array (
    0 => 'USD',
    1 => 'EUR',
    2 => 'GBP',
    3 => 'AUD',
    4 => 'ZAR',
  ),
  'bonus_first_deposit' => 
  array (
    'amount' => '100% + 240 FS',
    'min_deposit' => '$25',
    'wagering' => '15x(D+B)',
    'games_allowed' => 'Slots, Keno, Bingo, Specialty games (FS - Variety of Slots)',
    'code' => 'No code required',
  ),
  'bonus_free' => 
  array (
    'amount' => '$15',
    'min_deposit' => '',
    'wagering' => '20xB',
    'games_allowed' => 'Slots, Keno, Bingo, Specialty Games and Scratch Cards',
    'code' => 'No code required',
  ),
  'is_live_dealer' => '1',
  'date_established' => '2017-09-01',
  'emails' => 
  array (
    0 => 'support@24vipcasino.com',
  ),
  'phones' => 
  array (
    0 => 'None',
  ),
  'is_live_chat' => '1',
  'licenses' => 
  array (
    0 => 'Curacao',
  ),
  'certifiers' => 
  array (
  ),
  'affiliate_program' => 'Superior Share',
  'affiliate_link' => NULL,
  'withdrawal_minimum' => '0',
  'withdrawal_limits' => 
  array (
    0 => '$/€/£/AU$/R500 per day',
    1 => '$/€/£/AU$/R2000 per week',
  ),
  'withdrawal_timeframes' => 
  array (
    0 => 'Ewallets - 48-72 hours',
    1 => 'Bitcoin Wallet - 48-72 hours',
    2 => 'Credit cards - 2-7 business days',
  ),
  'deposit_methods' => 
  array (
    0 => 'Bitcoin Wallets',
    1 => 'EcoPayz EcoCard',
    2 => 'MasterCard',
    3 => 'Neteller',
    4 => 'Paysafe Card',
    5 => 'Skrill Moneybookers',
    6 => 'UPayCard',
    7 => 'Visa',
  ),
  'withdraw_methods' => 
  array (
    0 => 'Bitcoin Wallets',
    1 => 'EcoPayz EcoCard',
    2 => 'Neteller',
    3 => 'Skrill Moneybookers',
    4 => 'UPayCard',
    5 => 'Visa',
  ),
  'is_country_accepted' => '1',
  'is_language_accepted' => '1',
  'is_currency_accepted' => '1',
  'status' => NULL,
));
$this->response->setAttribute("total_reviews", 0);
$this->response->setAttribute("reviews", array (
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
    'title' => 'BetSoft Casinos',
    'url' => '/softwares/betsoft',
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
  'head_title' => 'Read 24VIP Casino Review at CasinosLists.com - 2018',
  'head_description' => 'Full 24VIP Casino Review | Full Details About 24VIP Casino, 24VIP Casino Bonuses and Coupons, Best Reviews at CasinosLists.com - 2018',
  'body_title' => '24VIP Casino review February 2018',
));

    }
}
        