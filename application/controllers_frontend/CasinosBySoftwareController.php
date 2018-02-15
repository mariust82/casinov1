<?php
class CasinosBySoftwareController extends Controller {
    public function run() {
        $this->response->setAttribute("selected_entity", 'NetEnt');
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
    'is_active' => true,
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
    'title' => 'NetEnt Casinos',
    'url' => '/softwares/netent',
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
$this->response->setAttribute("total_casinos", 617);
$this->response->setAttribute("casinos", array (
  0 => 
  array (
    'id' => '1357',
    'name' => 'Babe Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'NextGen Gaming',
      2 => 'Cryptologic',
      3 => 'iSoftBet',
      4 => 'Wazdan',
      5 => 'Evolution Gaming',
      6 => 'OMI Gaming',
      7 => 'Ezugi',
      8 => 'Multislot',
      9 => 'Playson',
      10 => 'ELK Studios',
      11 => 'Genesis Gaming',
      12 => 'Habanero',
      13 => 'GameArt',
      14 => 'Pariplay',
      15 => 'Genii',
      16 => 'Booming Games',
      17 => 'Pragmatic Play',
      18 => 'BetConstruct',
      19 => 'EGT',
      20 => 'Zeus Services',
      21 => 'Spigo',
      22 => 'Iron Dog Studio',
      23 => 'Join Games',
      24 => 'Casino Technology',
      25 => 'MrSlotty Games',
      26 => 'Patagonia Entertainment',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '200% + 100 FS',
      'min_deposit' => '€10',
      'wagering' => '40xB',
      'games_allowed' => 'Slots (FS - Fresh Fruits, Bake House, Santa Surprise, Under Water)',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2017-09-01',
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
  1 => 
  array (
    'id' => '1315',
    'name' => 'Breakout Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'Evolution Gaming',
      2 => 'Quickfire',
      3 => '1X2 Gaming',
      4 => 'Pariplay',
      5 => 'Pragmatic Play',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100%',
      'min_deposit' => '€10',
      'wagering' => '70xB',
      'games_allowed' => 'All',
      'code' => 'No code required',
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
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
  2 => 
  array (
    'id' => '1193',
    'name' => 'Mars Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'MicroGaming',
      1 => 'iSoftBet',
      2 => 'BetSoft',
      3 => 'NetEnt',
      4 => 'Ezugi',
      5 => 'SoftSwiss',
      6 => 'Amatic Industries',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100% + 50 FS',
      'min_deposit' => '$/€/£20',
      'wagering' => '40xB',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2017-02-01',
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
    'id' => '1184',
    'name' => 'Burnbet Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'Novomatic',
      2 => 'Playtech',
      3 => 'BetSoft',
      4 => 'RTG',
      5 => 'Aristocrat',
      6 => 'Igrosoft',
      7 => 'EGT',
      8 => 'Unicum',
      9 => 'Mega Jack',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100%',
      'min_deposit' => '€/£20',
      'wagering' => '35xB',
      'games_allowed' => 'All except Realtime Gaming,Playtech,Betsoft,Netent slots',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2016-01-15',
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
    'id' => '1016',
    'name' => 'Ramses Gold Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'NYX Interactive',
      2 => 'NextGen Gaming',
      3 => 'BetSoft',
      4 => 'Nektan',
      5 => 'Amaya Gaming',
      6 => 'Leander Games',
      7 => 'Thunderkick',
      8 => '1X2 Gaming',
      9 => 'ELK Studios',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '300%',
      'min_deposit' => '$/€/£20',
      'wagering' => '33x(D+B)',
      'games_allowed' => 'All',
      'code' => 'No code required',
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
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
  5 => 
  array (
    'id' => '920',
    'name' => 'Boss Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'MicroGaming',
      1 => 'Oryx Gaming',
      2 => 'iSoftBet',
      3 => 'BetSoft',
      4 => 'NetEnt',
      5 => 'Evolution Gaming',
      6 => '1X2 Gaming',
      7 => 'GameArt',
      8 => 'Intervision Gaming',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100%',
      'min_deposit' => '$/€20',
      'wagering' => '45xB',
      'games_allowed' => 'All',
      'code' => 'WELCOME',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2015-01-01',
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
    'id' => '917',
    'name' => 'Jojobet Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'MicroGaming',
      2 => 'iSoftBet',
      3 => 'Evolution Gaming',
      4 => 'Play n GO',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100% + 15 FS',
      'min_deposit' => '$/€10',
      'wagering' => '40x(D+B)',
      'games_allowed' => 'Netent Games',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2015-03-01',
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
    'id' => '790',
    'name' => 'Sugar Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'Oryx Gaming',
      2 => 'MicroGaming',
      3 => 'BetSoft',
      4 => 'Evolution Gaming',
      5 => 'Quickfire',
      6 => '1X2 Gaming',
      7 => 'Ezugi',
      8 => 'Intervision Gaming',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100% + 55 FS',
      'min_deposit' => '$/€/£10',
      'wagering' => '50x(D+B)',
      'games_allowed' => 'Slots except Scrooge, Devil\'s Delight and Bloodsuckers',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2015-05-20',
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
    'id' => '698',
    'name' => '7Bit Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'BetSoft',
      2 => 'Ezugi',
      3 => 'Endorphina',
      4 => 'SoftSwiss',
      5 => 'Amatic Industries',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100% + 25 FS',
      'min_deposit' => '$/€20',
      'wagering' => '40xB',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2014-11-01',
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
    'id' => '684',
    'name' => 'NederBet Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'MicroGaming',
      2 => 'BetSoft',
      3 => 'Evolution Gaming',
      4 => 'TAIN',
      5 => 'Play n GO',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '125% + 20 FS',
      'min_deposit' => '$/€25',
      'wagering' => '25xB',
      'games_allowed' => 'Slots (FS - Guns N Roses)',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2010-11-01',
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
    'id' => '682',
    'name' => 'Casino Girl',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'BetSoft',
      1 => 'Novomatic',
      2 => 'Playtech',
      3 => 'NetEnt',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '250%',
      'min_deposit' => '$/€20',
      'wagering' => '85xB',
      'games_allowed' => 'Betsoft Slots',
      'code' => '250SLOTS',
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
  11 => 
  array (
    'id' => '677',
    'name' => 'Vulkano Games Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'Novomatic',
      2 => 'Playtech',
      3 => 'Aristocrat',
      4 => 'Igrosoft',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100%',
      'min_deposit' => '$10',
      'wagering' => '35xB',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2009-01-01',
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
    'id' => '657',
    'name' => 'Parasino Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'NextGen Gaming',
      2 => 'World Match',
      3 => 'MicroGaming',
      4 => 'BetSoft',
      5 => 'Evolution Gaming',
      6 => 'Portomaso Gaming',
      7 => '1X2 Gaming',
      8 => 'Ezugi',
      9 => 'Play n GO',
      10 => 'SoftSwiss',
      11 => 'ELK Studios',
      12 => 'GameArt',
      13 => 'Pariplay',
      14 => 'Genii',
      15 => 'XPG',
      16 => 'Pragmatic Play',
      17 => 'BetConstruct',
      18 => 'Zeus Services',
      19 => 'MrSlotty Games',
      20 => 'Betgames TV',
      21 => 'Tom Horn',
      22 => 'Playsoft',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100% + 30 FS',
      'min_deposit' => '$/€/£10',
      'wagering' => '35xB',
      'games_allowed' => 'All except Video Poker,Roulette,Table Games & Live Casino',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2012-06-01',
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
    'id' => '587',
    'name' => 'Carat Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'MicroGaming',
      2 => 'Aberrant',
      3 => 'Play n GO',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100%',
      'min_deposit' => '€20',
      'wagering' => '40xB',
      'games_allowed' => 'Slots & Bingo',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2012-03-01',
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
    'id' => '509',
    'name' => 'Platinum Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'MicroGaming',
      1 => 'Novomatic',
      2 => 'Playtech',
      3 => 'BetSoft',
      4 => 'NetEnt',
      5 => 'RTG',
      6 => 'Aristocrat',
      7 => 'Igrosoft',
      8 => 'XPG',
      9 => 'EGT',
      10 => 'Unicum',
      11 => 'Mega Jack',
      12 => 'Alps Games',
      13 => 'Tom Horn',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100%',
      'min_deposit' => '$/€11',
      'wagering' => '20xB',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
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
    'is_country_accepted' => '1',
    'is_language_accepted' => NULL,
    'is_currency_accepted' => NULL,
  ),
  15 => 
  array (
    'id' => '319',
    'name' => 'Intrabahis Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'Evolution Gaming',
      2 => 'XPG',
      3 => 'Betgames TV',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100%',
      'min_deposit' => '$/€/£10',
      'wagering' => '80xB',
      'games_allowed' => 'NetEnt Slots',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2015-12-08',
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
    'id' => '250',
    'name' => 'Grand Wild Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'NYX Interactive',
      2 => 'MicroGaming',
      3 => 'iSoftBet',
      4 => 'Games OS',
      5 => 'Playson',
      6 => 'Pragmatic Play',
      7 => 'BetConstruct',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '150%',
      'min_deposit' => '$/€/£25',
      'wagering' => '1x(D+B)',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2013-01-01',
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
    'id' => '74',
    'name' => 'Carat Bingo',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'MicroGaming',
      2 => 'Aberrant',
      3 => 'Play n GO',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100%',
      'min_deposit' => '€10',
      'wagering' => '40x(D+B)',
      'games_allowed' => 'Slots,Bingo & Casino',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
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
  18 => 
  array (
    'id' => '1',
    'name' => 'Devilfish Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'NYX Interactive',
      2 => 'MicroGaming',
      3 => 'Leander Games',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '10% CB',
      'min_deposit' => '$/€/£10',
      'wagering' => '35xB',
      'games_allowed' => 'Slots,Scratchcards & Keno',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2005-07-01',
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
    'id' => '1122',
    'name' => 'Admiral Casino Club',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'Novomatic',
      2 => 'Playtech',
      3 => 'Quickspin',
      4 => 'Igrosoft',
      5 => 'Belatra Games',
      6 => 'Unicum',
      7 => 'Mega Jack',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100%',
      'min_deposit' => '500 RUB',
      'wagering' => '40xB',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
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
  20 => 
  array (
    'id' => '1118',
    'name' => 'Azartplay Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'Novomatic',
      2 => 'Playtech',
      3 => 'Quickspin',
      4 => 'Igrosoft',
      5 => 'Belatra Games',
      6 => 'Unicum',
      7 => 'Mega Jack',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '10% + 100 FS',
      'min_deposit' => '$10',
      'wagering' => '25xB',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
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
  21 => 
  array (
    'id' => '460',
    'name' => 'Bettilt Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'MicroGaming',
      1 => 'NYX Interactive',
      2 => 'Top Game',
      3 => 'iSoftBet',
      4 => 'NetEnt',
      5 => 'Yggdrasil Gaming',
      6 => 'Evolution Gaming',
      7 => 'Quickfire',
      8 => 'Ezugi',
      9 => 'BetConstruct',
      10 => 'BetGames',
      11 => 'Omega Gaming',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100% + 50 FS',
      'min_deposit' => '10',
      'wagering' => '30xB',
      'games_allowed' => 'All ( FS - Starburst )',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
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
  22 => 
  array (
    'id' => '227',
    'name' => 'Slotvoyager Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'Novomatic',
      2 => 'Playtech',
      3 => 'Igrosoft',
      4 => 'Belatra Games',
      5 => 'Unicum',
      6 => 'Mega Jack',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '5% CB',
      'min_deposit' => '$55',
      'wagering' => '30xB',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2013-01-01',
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
  23 => 
  array (
    'id' => '1376',
    'name' => 'MrXbet Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'NYX Interactive',
      2 => 'World Match',
      3 => 'iSoftBet',
      4 => 'BetSoft',
      5 => 'IGT',
      6 => 'Evolution Gaming',
      7 => 'Ezugi',
      8 => 'Play n GO',
      9 => 'XPG',
      10 => 'Kiron Interactive',
      11 => 'Betgames TV',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100%',
      'min_deposit' => ' €10',
      'wagering' => '40xB',
      'games_allowed' => 'All except jackpot 6000, Scrooge, Devil’s Delight, The Wish Master, Super Nudge 6000, Castle builder, Pearls of India, Tower Quest',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2017-05-01',
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
  24 => 
  array (
    'id' => '1003',
    'name' => 'Hilbet Casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'Evolution Gaming',
      2 => 'XPG',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '25%',
      'min_deposit' => '€20',
      'wagering' => '35x(D+B)',
      'games_allowed' => 'All',
      'code' => 'No code required',
    ),
    'bonus_free' => NULL,
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
        