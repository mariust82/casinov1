<?php
class CasinoInfoController extends Controller {
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
$this->response->setAttribute("casino", array (
  'id' => '1088',
  'name' => 'Lucky Ladies Bingo',
  'code' => 'lucky_ladies_bingo',
  'rating' => 5,
  'softwares' => 
  array (
    0 => 'MicroGaming',
    1 => 'Eyecon',
    2 => 'Cozy Games',
  ),
  'languages' => 
  array (
    0 => 'English',
  ),
  'currencies' => 
  array (
    0 => 'GBP',
  ),
  'bonus_first_deposit' => 
  array (
    'amount' => '500%',
    'min_deposit' => '£10',
    'wagering' => '10xB',
    'games_allowed' => 'Slots',
    'code' => 'No code required',
    'type' => 'First Deposit Bonus',
  ),
  'bonus_free' => 
  array (
    'amount' => '£10',
    'min_deposit' => '',
    'wagering' => '20xB',
    'games_allowed' => 'Slots',
    'code' => 'No code required',
    'type' => 'No Deposit Bonus',
  ),
  'is_live_dealer' => '0',
  'date_established' => '0000-00-00',
  'emails' => 
  array (
    0 => 'account@livebingonetwork.co.uk',
  ),
  'phones' => 
  array (
    0 => 'General: +44 0203-6081-305',
  ),
  'is_live_chat' => '1',
  'licenses' => 
  array (
    0 => 'Isle of Man',
  ),
  'certifiers' => 
  array (
    0 => 'iTech Labs',
    1 => 'GamCare',
  ),
  'affiliate_program' => 'Cozy Partners',
  'affiliate_link' => NULL,
  'withdrawal_minimum' => '£30',
  'withdrawal_limits' => 
  array (
    0 => '£1000 per week',
    1 => '£5000 per month',
  ),
  'withdrawal_timeframes' => 
  array (
    0 => 'Ewallets - immediate',
    1 => 'Credit cards - 4-5 business days',
  ),
  'deposit_methods' => 
  array (
    0 => 'Boku',
    1 => 'Maestro',
    2 => 'MasterCard',
    3 => 'Neteller',
    4 => 'Paysafe Card',
    5 => 'Skrill Moneybookers',
    6 => 'Visa',
    7 => 'Visa Electron',
  ),
  'withdraw_methods' => 
  array (
    0 => 'Boku',
    1 => 'Maestro',
    2 => 'MasterCard',
    3 => 'Neteller',
    4 => 'Paysafe Card',
    5 => 'Skrill Moneybookers',
    6 => 'Visa',
    7 => 'Visa Electron',
  ),
  'is_country_accepted' => '0',
  'is_language_accepted' => '0',
  'is_currency_accepted' => '0',
  'note' => NULL,
  'invision_casino_id' => NULL,
  'status' => NULL,
));
$this->response->setAttribute("user_score", 0);
$this->response->setAttribute("total_reviews", 0);
$this->response->setAttribute("reviews", array (
));
$this->response->setAttribute("page_info", array (
  'head_title' => 'Lucky Ladies Bingo Review with Authentic Players Reviews & Ratings!',
  'head_description' => ' Complete Lucky Ladies Bingo Review | Go through authentic and transparent real players reviews about Lucky Ladies Bingo and user-based Ratings at CasinosLists.com',
  'body_title' => 'Lucky Ladies Bingo Review',
));
$this->response->setAttribute("version", '0.8.3.7');
$this->response->setAttribute("tms", array (
));

    }
}
        