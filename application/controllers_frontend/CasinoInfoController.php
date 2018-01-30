<?php
class CasinoInfoController extends Controller {
    public function run() {
        $this->response->setAttribute("country", array (
  'id' => '34',
  'code' => 'US',
  'name' => 'United States',
));
$this->response->setAttribute("casino", array (
  'id' => '257',
  'name' => 'Jackpot Capital',
  'rating' => '0.1429',
  'softwares' => 
  array (
    0 => 'RTG',
  ),
  'languages' => 
  array (
    0 => 'English',
  ),
  'currencies' => 
  array (
    0 => 'USD',
  ),
  'bonus_first_deposit' => 
  array (
    'amount' => '150% + 20 FS',
    'min_deposit' => '$20',
    'wagering' => '30x(D+B)',
    'games_allowed' => 'All (FS - Ninja Star)',
    'code' => 'BIGFREECHIPLIST300',
  ),
  'bonus_free' => 
  array (
    'amount' => '$25',
    'min_deposit' => '',
    'wagering' => '60xB',
    'games_allowed' => 'Slots,Keno & 7 Stud Poker,Pai Gow Poker',
    'code' => 'THEBIGFREECHIPLIST',
  ),
  'is_live_dealer' => '0',
  'date_established' => '2008-01-01',
  'emails' => 
  array (
    0 => 'info@jackpotcapitalsupport.eu',
  ),
  'phones' => 
  array (
    0 => 'General: +1 678-349-0095',
    1 => 'USA: +1 800-571-7009',
  ),
  'is_live_chat' => '1',
  'licenses' => 
  array (
    0 => 'Curacao',
  ),
  'certifiers' => 
  array (
  ),
  'affiliate_program' => 'Jackpot Capital Affiliates',
  'affiliate_link' => NULL,
  'withdrawal_minimum' => '$25',
  'withdrawal_limits' => 
  array (
    0 => '$10000 per week',
  ),
  'withdrawal_timeframes' => 
  array (
    0 => 'Ewallets - 2-3 business days',
    1 => 'Wire Transfer - up to 15 business days',
  ),
  'deposit_methods' => 
  array (
    0 => 'American Express',
    1 => 'Bitcoin Wallets',
    2 => 'EcoPayz EcoCard',
    3 => 'MasterCard',
    4 => 'Neteller',
    5 => 'Paysafe Card',
    6 => 'Skrill Moneybookers',
    7 => 'Visa',
    8 => 'Western Union',
    9 => 'Wire Transfer',
  ),
  'withdraw_methods' => 
  array (
    0 => 'American Express',
    1 => 'Bitcoin Wallets',
    2 => 'EcoPayz EcoCard',
    3 => 'Neteller',
    4 => 'Skrill Moneybookers',
    5 => 'Wire Transfer',
  ),
  'is_country_accepted' => '1',
  'is_language_accepted' => '1',
  'is_currency_accepted' => '1',
  'status' => NULL,
));
$this->response->setAttribute("total_reviews", '6');
$this->response->setAttribute("reviews", array (
  0 => 
  array (
    'id' => '6',
    'name' => 'Tester',
    'email' => 'a@a.com',
    'body' => 'I\'m testing this functionality!',
    'likes' => '0',
    'ip' => NULL,
    'country' => 'United States',
    'rating' => 7,
    'date' => '2018-01-26 12:36:34',
    'parent' => NULL,
    'children' => 
    array (
    ),
    'total_children' => 0,
  ),
  1 => 
  array (
    'id' => '4',
    'name' => 'Tester',
    'email' => 'a@a.com',
    'body' => 'I\'m testing this functionality!',
    'likes' => '0',
    'ip' => NULL,
    'country' => 'United States',
    'rating' => 7,
    'date' => '2018-01-26 12:36:26',
    'parent' => NULL,
    'children' => 
    array (
    ),
    'total_children' => 0,
  ),
  2 => 
  array (
    'id' => '5',
    'name' => 'Tester',
    'email' => 'a@a.com',
    'body' => 'I\'m testing this functionality!',
    'likes' => '0',
    'ip' => NULL,
    'country' => 'United States',
    'rating' => 7,
    'date' => '2018-01-26 12:36:26',
    'parent' => NULL,
    'children' => 
    array (
    ),
    'total_children' => 0,
  ),
  3 => 
  array (
    'id' => '3',
    'name' => 'Tester',
    'email' => 'a@a.com',
    'body' => 'I\'m testing this functionality!',
    'likes' => '0',
    'ip' => NULL,
    'country' => 'United States',
    'rating' => 7,
    'date' => '2018-01-26 12:36:25',
    'parent' => NULL,
    'children' => 
    array (
    ),
    'total_children' => 0,
  ),
  4 => 
  array (
    'id' => '2',
    'name' => 'Tester',
    'email' => 'a@a.com',
    'body' => 'I\'m testing this functionality!',
    'likes' => '0',
    'ip' => NULL,
    'country' => 'United States',
    'rating' => 7,
    'date' => '2018-01-26 12:36:23',
    'parent' => NULL,
    'children' => 
    array (
    ),
    'total_children' => 0,
  ),
));
$this->response->setAttribute("menu", array (
  '/countries-list/united-states' => 'United States Casinos',
  '/softwares/rtg' => 'RTG Casinos',
  '/bonus-list/no-deposit-bonus' => 'No Deposit Casinos',
  '/casinos/best' => 'Best Casinos',
  '/casinos/safe' => 'Safe Casinos',
  '/casinos/new' => 'New Casinos',
  '/casinos/recommended' => 'Recommended Casinos',
  '/casinos/stay-away' => 'Stay Away Casinos',
));

    }
}
        