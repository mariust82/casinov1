<?php
class CasinoLiveDealerController extends Lucinda\MVC\STDOUT\Controller {
    public function run() {
        $this->response->attributes("country", array (
  'id' => '43',
  'code' => 'RO',
  'name' => 'Romania',
));
$this->response->attributes("menu_top", array (
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
    'title' => 'LIVE',
    'url' => '/features/live-dealer',
    'is_active' => true,
    'submenuItems' => 
    array (
      0 => 
      array (
        'title' => 'Live Roulette Casinos',
        'url' => '/live-dealer/roulette',
        'is_active' => true,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      1 => 
      array (
        'title' => 'Live Blackjack Casinos',
        'url' => '/live-dealer/blackjack',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      2 => 
      array (
        'title' => 'Live Baccarat Casinos',
        'url' => '/live-dealer/baccarat',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      3 => 
      array (
        'title' => 'Live Craps Casinos',
        'url' => '/live-dealer/craps',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      4 => 
      array (
        'title' => 'Live Dealer Casinos',
        'url' => '/features/live-dealer',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
    ),
    'have_submenu' => true,
  ),
  3 => 
  array (
    'title' => 'CASINOS',
    'url' => '/casinos',
    'is_active' => false,
    'submenuItems' => 
    array (
      0 => 
      array (
        'title' => 'Best Casinos',
        'url' => '/casinos/best',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      1 => 
      array (
        'title' => 'Mobile Casinos',
        'url' => '/casinos/mobile',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      2 => 
      array (
        'title' => 'Low Wagering Casinos',
        'url' => '/casinos/low-wagering',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      3 => 
      array (
        'title' => 'eCOGRA Casinos',
        'url' => '/features/ecogra-casinos',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      4 => 
      array (
        'title' => 'Blacklisted Casinos',
        'url' => '/casinos/stay-away',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      5 => 
      array (
        'title' => 'Popular Casinos',
        'url' => '/casinos/popular',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      6 => 
      array (
        'title' => 'No Account Casinos',
        'url' => '/casinos/no-account-casinos',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      7 => 
      array (
        'title' => 'All Casinos',
        'url' => '/casinos',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
    ),
    'have_submenu' => true,
  ),
  4 => 
  array (
    'title' => 'SOFTWARES',
    'url' => '/softwares',
    'is_active' => false,
    'submenuItems' => 
    array (
      0 => 
      array (
        'title' => 'RTG Casinos',
        'url' => '/softwares/rtg',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      1 => 
      array (
        'title' => 'Rival Casinos',
        'url' => '/softwares/rival',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      2 => 
      array (
        'title' => 'NetEnt Casinos',
        'url' => '/softwares/netent',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      3 => 
      array (
        'title' => 'Playtech Casinos',
        'url' => '/softwares/playtech',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      4 => 
      array (
        'title' => 'MicroGaming Casinos',
        'url' => '/softwares/microgaming',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      5 => 
      array (
        'title' => 'BetSoft Casinos',
        'url' => '/softwares/betsoft',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      6 => 
      array (
        'title' => 'Saucify Casinos',
        'url' => '/softwares/saucify',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      7 => 
      array (
        'title' => 'Cryptologic Casinos',
        'url' => '/softwares/cryptologic',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      8 => 
      array (
        'title' => 'All Softwares',
        'url' => '/softwares',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
    ),
    'have_submenu' => true,
  ),
  5 => 
  array (
    'title' => 'COUNTRIES',
    'url' => '/countries',
    'is_active' => false,
    'submenuItems' => 
    array (
      0 => 
      array (
        'title' => 'Romania Casinos',
        'url' => '/countries-list/romania',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      1 => 
      array (
        'title' => 'USA Casinos',
        'url' => '/countries-list/united-states',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      2 => 
      array (
        'title' => 'UK Casinos',
        'url' => '/countries-list/united-kingdom',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      3 => 
      array (
        'title' => 'Australia Casinos',
        'url' => '/countries-list/australia',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      4 => 
      array (
        'title' => 'Germany Casinos',
        'url' => '/countries-list/germany',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      5 => 
      array (
        'title' => 'New Zealand Casinos',
        'url' => '/countries-list/new-zealand',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      6 => 
      array (
        'title' => 'Netherlands Casinos',
        'url' => '/countries-list/netherlands',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      7 => 
      array (
        'title' => 'Sweden Casinos',
        'url' => '/countries-list/sweden',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      8 => 
      array (
        'title' => 'All Countries',
        'url' => '/countries ',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
    ),
    'have_submenu' => true,
  ),
  6 => 
  array (
    'title' => 'BANKING',
    'url' => '/banking',
    'is_active' => false,
    'submenuItems' => 
    array (
      0 => 
      array (
        'title' => 'Neteller Casinos',
        'url' => '/banking/neteller',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      1 => 
      array (
        'title' => 'Skrill Moneybookers Casinos',
        'url' => '/banking/skrill-moneybookers',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      2 => 
      array (
        'title' => 'PayPal Casinos',
        'url' => '/banking/paypal',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      3 => 
      array (
        'title' => 'Bitcoin Wallets Casinos',
        'url' => '/banking/bitcoin-wallets',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      4 => 
      array (
        'title' => 'EcoPayz EcoCard Casinos',
        'url' => '/banking/ecopayz-ecocard',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      5 => 
      array (
        'title' => 'Paysafe Card',
        'url' => '/banking/paysafe-card',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      6 => 
      array (
        'title' => 'All Banking',
        'url' => '/banking',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
    ),
    'have_submenu' => true,
  ),
  7 => 
  array (
    'title' => 'GAMES',
    'url' => '/games',
    'is_active' => false,
    'submenuItems' => 
    array (
      0 => 
      array (
        'title' => 'Video Slots',
        'url' => '/games/video-slots',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      1 => 
      array (
        'title' => 'Classic Slots',
        'url' => '/games/classic-slots',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      2 => 
      array (
        'title' => 'Video Poker',
        'url' => '/games/video-poker',
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
        'title' => 'Roulette',
        'url' => '/games/roulette',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      6 => 
      array (
        'title' => 'Table Games',
        'url' => '/games/table-games',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      7 => 
      array (
        'title' => 'Bingo',
        'url' => '/games/bingo',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      8 => 
      array (
        'title' => 'Baccarat',
        'url' => '/games/baccarat',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      9 => 
      array (
        'title' => 'Craps',
        'url' => '/games/craps',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      10 => 
      array (
        'title' => 'Keno',
        'url' => '/games/keno',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      11 => 
      array (
        'title' => 'Other',
        'url' => '/games/other',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      12 => 
      array (
        'title' => 'All Games',
        'url' => '/games',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
    ),
    'have_submenu' => true,
  ),
  8 => 
  array (
    'title' => 'BLOG',
    'url' => '/blog',
    'is_active' => false,
    'submenuItems' => 
    array (
      0 => 
      array (
        'title' => 'News',
        'url' => '/blog/news',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      1 => 
      array (
        'title' => 'Guides',
        'url' => '/blog/guides',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
      2 => 
      array (
        'title' => 'All Blog Articles',
        'url' => '/blog',
        'is_active' => false,
        'submenuItems' => 
        array (
        ),
        'have_submenu' => false,
      ),
    ),
    'have_submenu' => true,
  ),
));
$this->response->attributes("selected_entity", 'Roulette');
$this->response->attributes("is_mobile", false);
$this->response->attributes("menu_bottom", array (
  0 => 
  array (
    'title' => 'Romania Casinos',
    'url' => '/countries-list/romania',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  1 => 
  array (
    'title' => 'Roulette Casinos',
    'url' => '/live-dealer/roulette',
    'is_active' => true,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  2 => 
  array (
    'title' => 'No Deposit Casinos',
    'url' => '/bonus-list/no-deposit-bonus',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  3 => 
  array (
    'title' => 'Best Casinos',
    'url' => '/casinos/best',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  4 => 
  array (
    'title' => 'Mobile Casinos',
    'url' => '/casinos/mobile',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  5 => 
  array (
    'title' => 'Low Wagering Casinos',
    'url' => '/casinos/low-wagering',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  6 => 
  array (
    'title' => 'New Casinos',
    'url' => '/casinos/new',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  7 => 
  array (
    'title' => 'Blacklisted Casinos',
    'url' => '/casinos/stay-away',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  8 => 
  array (
    'title' => 'No Account Casinos',
    'url' => '/casinos/no-account-casinos',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  9 => 
  array (
    'title' => 'All Casinos',
    'url' => '/casinos',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
));
$this->response->attributes("filter", 'feature');
$this->response->attributes("sort_criteria", 1);
$this->response->attributes("total_casinos", '22');
$this->response->attributes("casinos", array (
  0 => 
  array (
    'id' => '95',
    'name' => 'Aztec Riches Casino',
    'code' => 'aztec_riches_casino',
    'rating' => 6,
    'softwares' => 
    array (
      0 => 'MicroGaming',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '50%',
      'min_deposit' => '$/€/£20',
      'wagering' => '60xB',
      'games_allowed' => 'All',
      'code' => 'No code required',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => NULL,
    'live_dealers' => NULL,
    'date_established' => '2002-10-01',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '0',
    'logo_big' => '/public/sync/casino_logo_light/124x82/aztec_riches_casino.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/aztec_riches_casino.png',
    'new' => false,
    'score_class' => 'Good',
    'all_softwares' => NULL,
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'Oct 01, 2002',
    'status' => '0',
  ),
  1 => 
  array (
    'id' => '1471',
    'name' => 'SlotoCash Andreea',
    'code' => 'sloto_cash',
    'rating' => 9,
    'softwares' => 
    array (
      0 => 'RTG',
      1 => '21GNET',
      2 => '2By2 Gaming',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '200% + 100<abbr title="Free Spins"> FS',
      'min_deposit' => '$20',
      'wagering' => '25x(D+B)',
      'games_allowed' => 'All (FS - Pig Winner)',
      'code' => 'SLOTO1MATCH',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => NULL,
    'live_dealers' => NULL,
    'date_established' => '2007-03-01',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '1',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '0',
    'logo_big' => '/public/sync/casino_logo_light/124x82/sloto_cash.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/sloto_cash.png',
    'new' => false,
    'score_class' => 'Excellent',
    'all_softwares' => '21GNET, 2By2 Gaming',
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'Mar 01, 2007',
    'status' => '0',
  ),
  2 => 
  array (
    'id' => '1422',
    'name' => 'Dream Jackpot Andreea',
    'code' => 'dream_jackpot_casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'Scientific Games',
      2 => 'Lightning Box Games',
      3 => 'Barcrest Games',
      4 => 'Realistic Games',
      5 => 'Bally',
      6 => 'Rabcat',
      7 => 'Big Time Gaming',
      8 => 'ELK Studios',
      9 => 'Play n GO',
      10 => 'Chance Interactive',
      11 => 'Betdigital',
      12 => 'WMS',
      13 => 'Games Warehouse',
      14 => 'Cayetano Gaming',
      15 => '2By2 Gaming',
      16 => 'Quickspin',
      17 => 'Evolution Gaming',
      18 => 'Leander Games',
      19 => 'WMS Gaming',
      20 => 'MicroGaming',
      21 => 'NYX Interactive',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100%+50<abbr title="Free Spins"> FS',
      'min_deposit' => '20',
      'wagering' => '35x(D+B)',
      'games_allowed' => 'Slots, Scratchcards & Keno (FS-Starburst)',
      'code' => 'no code',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => NULL,
    'live_dealers' => NULL,
    'date_established' => '2017-03-01',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '0',
    'logo_big' => '/public/sync/casino_logo_light/124x82/dream_jackpot_casino.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/dream_jackpot_casino.png',
    'new' => false,
    'score_class' => 'No score',
    'all_softwares' => 'Scientific Games, Lightning Box Games, Barcrest Games, Realistic Games, Bally, Rabcat, Big Time Gaming, ELK Studios, Play n GO, Chance Interactive, Betdigital, WMS, Games Warehouse, Cayetano Gaming, 2By2 Gaming, Quickspin, Evolution Gaming, Leander Games, WMS Gaming, MicroGaming, NYX Interactive',
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'Mar 01, 2017',
    'status' => '0',
  ),
  3 => 
  array (
    'id' => '1411',
    'name' => 'Montecrypos Casino Habiba',
    'code' => 'montecrypotos_casino_id',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'Felt Gaming',
      2 => 'MicroGaming',
      3 => 'Habanero',
      4 => 'Big Time Gaming',
      5 => 'Endorphina',
      6 => 'Play n GO',
      7 => 'Push Gaming',
      8 => 'Ezugi',
      9 => 'Quickspin',
      10 => 'Evolution Gaming',
      11 => 'BetSoft',
      12 => 'GameArt',
      13 => 'Pariplay',
      14 => 'Booming Games',
      15 => 'Fugaso',
      16 => 'Evoplay',
      17 => 'Kiron Interactive',
      18 => 'Pragmatic Play',
      19 => 'iSoftBet',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '120% + 120<abbr title="Free Spins"> FS',
      'min_deposit' => '€30',
      'wagering' => '35x(D+B)',
      'games_allowed' => 'All',
      'code' => 'No code',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => NULL,
    'live_dealers' => NULL,
    'date_established' => '2019-08-14',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '0',
    'logo_big' => '/public/sync/casino_logo_light/124x82/no-logo-124x82.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/no-logo-85x56.png',
    'new' => true,
    'score_class' => 'No score',
    'all_softwares' => 'Felt Gaming, MicroGaming, Habanero, Big Time Gaming, Endorphina, Play n GO, Push Gaming, Ezugi, Quickspin, Evolution Gaming, BetSoft, GameArt, Pariplay, Booming Games, Fugaso, Evoplay, Kiron Interactive, Pragmatic Play, iSoftBet',
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'Aug 14, 2019',
    'status' => '0',
  ),
  4 => 
  array (
    'id' => '1575',
    'name' => 'Jetbull Casino Abel',
    'code' => 'jetbull_casino_abel',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Intouch Games',
      1 => 'MrSlotty Games',
      2 => 'Booming Games',
      3 => 'Genii',
      4 => 'Relax Gaming',
      5 => 'GameArt',
      6 => 'Blueprint Gaming',
      7 => 'Habanero',
      8 => 'Eyecon',
      9 => 'ELK Studios',
      10 => 'Endorphina',
      11 => 'Multislot',
      12 => 'Pragmatic Play',
      13 => 'EGT',
      14 => 'Red Rake Gaming',
      15 => 'Booongo',
      16 => 'Fugaso',
      17 => 'Tom Horn',
      18 => 'Join Games',
      19 => 'Gamevy',
      20 => 'Spinomenal',
      21 => 'Spigo',
      22 => 'Williams Interactive',
      23 => 'Kiron Interactive',
      24 => 'Push Gaming',
      25 => 'Vivo Gaming',
      26 => 'Oryx Gaming',
      27 => 'NextGen Gaming',
      28 => 'MicroGaming',
      29 => 'Cryptologic',
      30 => '1X2 Gaming',
      31 => 'Quickspin',
      32 => 'OMI Gaming',
      33 => 'Thunderkick',
      34 => 'Yggdrasil Gaming',
      35 => 'IGT',
      36 => 'NetEnt',
      37 => 'Wazdan',
      38 => 'BetSoft',
      39 => 'iSoftBet',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '€150',
      'min_deposit' => '€10.',
      'wagering' => '40x(D+B)',
      'games_allowed' => 'All, except specified games',
      'code' => 'No code required ',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => NULL,
    'live_dealers' => NULL,
    'date_established' => '2007-01-01',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '1',
    'logo_big' => '/public/sync/casino_logo_light/124x82/no-logo-124x82.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/no-logo-85x56.png',
    'new' => false,
    'score_class' => 'No score',
    'all_softwares' => 'MrSlotty Games, Booming Games, Genii, Relax Gaming, GameArt, Blueprint Gaming, Habanero, Eyecon, ELK Studios, Endorphina, Multislot, Pragmatic Play, EGT, Red Rake Gaming, Booongo, Fugaso, Tom Horn, Join Games, Gamevy, Spinomenal, Spigo, Williams Interactive, Kiron Interactive, Push Gaming, Vivo Gaming, Oryx Gaming, NextGen Gaming, MicroGaming, Cryptologic, 1X2 Gaming, Quickspin, OMI Gaming, Thunderkick, Yggdrasil Gaming, IGT, NetEnt, Wazdan, BetSoft, iSoftBet',
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'Jan 01, 2007',
    'status' => '0',
  ),
  5 => 
  array (
    'id' => '1574',
    'name' => 'React Casino Abel',
    'code' => 'react_casino',
    'rating' => 9,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'Play n GO',
      2 => 'OMI Gaming',
      3 => 'Evolution Gaming',
      4 => 'iSoftBet',
      5 => 'MicroGaming',
      6 => 'NYX Interactive',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100% + 50 <abbr title="Free Spins"> FS',
      'min_deposit' => '€/£200',
      'wagering' => '40x(D+B)',
      'games_allowed' => 'Drive Multiplier Mayhem',
      'code' => 'no code',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => NULL,
    'live_dealers' => NULL,
    'date_established' => '2019-11-06',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '1',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '1',
    'logo_big' => '/public/sync/casino_logo_light/124x82/react_casino.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/react_casino.png',
    'new' => true,
    'score_class' => 'Excellent',
    'all_softwares' => 'Play n GO, OMI Gaming, Evolution Gaming, iSoftBet, MicroGaming, NYX Interactive',
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'Nov 06, 2019',
    'status' => '0',
  ),
  6 => 
  array (
    'id' => '1570',
    'name' => 'Casinia Casino Abel',
    'code' => 'casinia_casino_abel',
    'rating' => 6,
    'softwares' => 
    array (
      0 => 'Quickspin',
      1 => 'Ezugi',
      2 => '1X2 Gaming',
      3 => 'Tom Horn',
      4 => 'Iron Dog Studio',
      5 => 'Booongo',
      6 => 'Push Gaming',
      7 => 'EGT',
      8 => 'Pragmatic Play',
      9 => 'Spinomenal',
      10 => 'Relax Gaming',
      11 => 'Merkur Gaming',
      12 => 'GameArt',
      13 => 'Bally',
      14 => 'Habanero',
      15 => 'Endorphina',
      16 => 'Amatic Industries',
      17 => 'Evolution Gaming',
      18 => 'Yggdrasil Gaming',
      19 => 'Wazdan',
      20 => 'BetSoft',
      21 => 'iSoftBet',
      22 => 'Gamomat',
      23 => 'Casino Technology',
      24 => 'Red Rake Gaming',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100% + 200 <abbr title="Free Spins"> FS',
      'min_deposit' => '€20',
      'wagering' => '30x(D+B)',
      'games_allowed' => 'all',
      'code' => 'no code',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => NULL,
    'live_dealers' => NULL,
    'date_established' => '2016-01-01',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '1',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '1',
    'logo_big' => '/public/sync/casino_logo_light/124x82/no-logo-124x82.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/no-logo-85x56.png',
    'new' => false,
    'score_class' => 'Good',
    'all_softwares' => 'Ezugi, 1X2 Gaming, Tom Horn, Iron Dog Studio, Booongo, Push Gaming, EGT, Pragmatic Play, Spinomenal, Relax Gaming, Merkur Gaming, GameArt, Bally, Habanero, Endorphina, Amatic Industries, Evolution Gaming, Yggdrasil Gaming, Wazdan, BetSoft, iSoftBet, Gamomat, Casino Technology, Red Rake Gaming',
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'Jan 01, 2016',
    'status' => '0',
  ),
  7 => 
  array (
    'id' => '1504',
    'name' => 'Thebes Casino Anda',
    'code' => 'thebes_casino_anda',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'Pragmatic Play',
      1 => 'Octopus Gaming',
      2 => 'Vivo Gaming',
      3 => 'BetSoft',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '200% + 25 <abbr title="Free Spins"> FS',
      'min_deposit' => '€2.000',
      'wagering' => '35xB',
      'games_allowed' => 'All',
      'code' => 'No code',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => NULL,
    'live_dealers' => NULL,
    'date_established' => '1999-07-04',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '1',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '1',
    'logo_big' => '/public/sync/casino_logo_light/124x82/no-logo-124x82.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/no-logo-85x56.png',
    'new' => false,
    'score_class' => 'No score',
    'all_softwares' => 'Octopus Gaming, Vivo Gaming, BetSoft',
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'Jul 04, 1999',
    'status' => '0',
  ),
  8 => 
  array (
    'id' => '1503',
    'name' => 'SlotoCash Anda',
    'code' => 'sloto_cash_anda',
    'rating' => 8,
    'softwares' => 
    array (
      0 => 'RTG',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '200% + 100 <abbr title="Free Spins"> FS',
      'min_deposit' => '$20',
      'wagering' => '25x(D+B)',
      'games_allowed' => 'Pig Winner',
      'code' => 'SLOTO1MATCH',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => NULL,
    'live_dealers' => NULL,
    'date_established' => '2018-07-04',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '1',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '1',
    'logo_big' => '/public/sync/casino_logo_light/124x82/no-logo-124x82.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/no-logo-85x56.png',
    'new' => false,
    'score_class' => 'Excellent',
    'all_softwares' => NULL,
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'Jul 04, 2018',
    'status' => '0',
  ),
  9 => 
  array (
    'id' => '1500',
    'name' => 'uk casino Anda',
    'code' => 'uk_casino_anda',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NextGen Gaming',
      1 => 'Lightning Box Games',
      2 => 'Barcrest Games',
      3 => 'Realistic Games',
      4 => 'Blueprint Gaming',
      5 => 'Bally',
      6 => 'Eyecon',
      7 => 'High 5 Games',
      8 => 'Big Time Gaming',
      9 => 'ELK Studios',
      10 => 'OpenBet',
      11 => 'Evolution Gaming',
      12 => 'Scientific Games',
      13 => 'Ainsworth',
      14 => 'Inspired',
      15 => 'WMS',
      16 => 'Core Gaming',
      17 => 'Thunderkick',
      18 => 'Yggdrasil Gaming',
      19 => 'IGT',
      20 => 'NetEnt',
      21 => 'iSoftBet',
      22 => 'Novomatic',
      23 => 'MicroGaming',
      24 => 'NYX Interactive',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '10% <abbr title="Cashback "> CB',
      'min_deposit' => '£10',
      'wagering' => '0',
      'games_allowed' => 'Slots, table games, Live Casino',
      'code' => 'no code',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => 
    array (
      'amount' => '10',
      'min_deposit' => '',
      'wagering' => '0',
      'games_allowed' => 'Book of Dead',
      'code' => 'no code',
      'type' => 'Free Spins',
      'bonus_type_Abbreviation' => 'FS',
    ),
    'live_dealers' => NULL,
    'date_established' => '2013-12-06',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '1',
    'logo_big' => '/public/sync/casino_logo_light/124x82/no-logo-124x82.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/no-logo-85x56.png',
    'new' => false,
    'score_class' => 'No score',
    'all_softwares' => 'Lightning Box Games, Barcrest Games, Realistic Games, Blueprint Gaming, Bally, Eyecon, High 5 Games, Big Time Gaming, ELK Studios, OpenBet, Evolution Gaming, Scientific Games, Ainsworth, Inspired, WMS, Core Gaming, Thunderkick, Yggdrasil Gaming, IGT, NetEnt, iSoftBet, Novomatic, MicroGaming, NYX Interactive',
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'Dec 06, 2013',
    'status' => '0',
  ),
  10 => 
  array (
    'id' => '1407',
    'name' => 'Jetbull Casino Irina',
    'code' => 'jetbull_casino_irina',
    'rating' => 9,
    'softwares' => 
    array (
      0 => 'NetEnt',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '33 <abbr title="Free Spins"> FS',
      'min_deposit' => '€10',
      'wagering' => '30xB',
      'games_allowed' => 'All games except Poker games, non-live Table Games, some Slot Games',
      'code' => 'No Code',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => NULL,
    'live_dealers' => NULL,
    'date_established' => '2019-04-03',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '1',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '0',
    'logo_big' => '/public/sync/casino_logo_light/124x82/no-logo-124x82.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/no-logo-85x56.png',
    'new' => true,
    'score_class' => 'Excellent',
    'all_softwares' => NULL,
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'Apr 03, 2019',
    'status' => '0',
  ),
  11 => 
  array (
    'id' => '1398',
    'name' => 'Total Gold Habiba',
    'code' => 'total_gold_habiba',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '554',
      'min_deposit' => '55',
      'wagering' => '30xB',
      'games_allowed' => 'Slots, PJPSlots, Arcade, ScratchCards, Keno',
      'code' => 'No code',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => NULL,
    'live_dealers' => NULL,
    'date_established' => '2014-01-01',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '1',
    'logo_big' => '/public/sync/casino_logo_light/124x82/no-logo-124x82.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/no-logo-85x56.png',
    'new' => false,
    'score_class' => 'No score',
    'all_softwares' => NULL,
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'Jan 01, 2014',
    'status' => '0',
  ),
  12 => 
  array (
    'id' => '1396',
    'name' => 'jackpot Paradise Casino Habiba',
    'code' => 'jackpot_paradise_casino_habiba',
    'rating' => 0,
    'softwares' => 
    array (
      0 => '2By2 Gaming',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '1',
      'min_deposit' => '1',
      'wagering' => '1',
      'games_allowed' => 'All ',
      'code' => 'No Code',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => NULL,
    'live_dealers' => NULL,
    'date_established' => '2012-01-01',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '1',
    'logo_big' => '/public/sync/casino_logo_light/124x82/no-logo-124x82.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/no-logo-85x56.png',
    'new' => false,
    'score_class' => 'No score',
    'all_softwares' => NULL,
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'Jan 01, 2012',
    'status' => '0',
  ),
  13 => 
  array (
    'id' => '1394',
    'name' => 'UK Casino Habiba',
    'code' => 'uk_casinohabiba',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'MicroGaming',
      1 => 'WMS',
      2 => 'NetEnt',
      3 => 'Core Gaming',
      4 => 'Scientific Games',
      5 => 'Barcrest Games',
      6 => 'Realistic Games',
      7 => 'Blueprint Gaming',
      8 => 'Bally',
      9 => 'Eyecon',
      10 => 'Evolution Gaming',
      11 => 'IGT',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '10% <abbr title="Cashback "> CB',
      'min_deposit' => '£10',
      'wagering' => '0',
      'games_allowed' => 'All',
      'code' => 'No code',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => 
    array (
      'amount' => '£10',
      'min_deposit' => '',
      'wagering' => '99xB',
      'games_allowed' => 'All',
      'code' => 'No code',
      'type' => 'No Deposit Bonus',
      'bonus_type_Abbreviation' => 'NDB',
    ),
    'live_dealers' => NULL,
    'date_established' => NULL,
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '1',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '1',
    'logo_big' => '/public/sync/casino_logo_light/124x82/no-logo-124x82.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/no-logo-85x56.png',
    'new' => true,
    'score_class' => 'No score',
    'all_softwares' => 'WMS, NetEnt, Core Gaming, Scientific Games, Barcrest Games, Realistic Games, Blueprint Gaming, Bally, Eyecon, Evolution Gaming, IGT',
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'None',
    'status' => '0',
  ),
  14 => 
  array (
    'id' => '1392',
    'name' => 'Total Gold Casino Diana',
    'code' => 'total_gold_casino_D',
    'rating' => 0,
    'softwares' => 
    array (
      0 => '888 Software',
      1 => 'NetEnt',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100% + 25 <abbr title="Free Spins"> FS',
      'min_deposit' => '£20 ',
      'wagering' => '30xB',
      'games_allowed' => 'Slots',
      'code' => 'No code',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => NULL,
    'live_dealers' => NULL,
    'date_established' => '1997-10-01',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '1',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '1',
    'logo_big' => '/public/sync/casino_logo_light/124x82/no-logo-124x82.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/no-logo-85x56.png',
    'new' => false,
    'score_class' => 'No score',
    'all_softwares' => 'NetEnt',
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'Oct 01, 1997',
    'status' => '0',
  ),
  15 => 
  array (
    'id' => '1391',
    'name' => 'Jackpot Paradise Casino Diana',
    'code' => 'jackpot_paradise_casino_D',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'ProgressPlay',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100%',
      'min_deposit' => '$/£/€10 ',
      'wagering' => '50x B',
      'games_allowed' => 'All',
      'code' => 'No code',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => NULL,
    'live_dealers' => NULL,
    'date_established' => '2012-08-01',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '1',
    'logo_big' => '/public/sync/casino_logo_light/124x82/no-logo-124x82.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/no-logo-85x56.png',
    'new' => false,
    'score_class' => 'No score',
    'all_softwares' => NULL,
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'Aug 01, 2012',
    'status' => '0',
  ),
  16 => 
  array (
    'id' => '1389',
    'name' => 'Dream Jackpot Casino Diana',
    'code' => 'dream_jackpot_casino_diana',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'Felt Gaming',
      2 => 'Multicommerce Game Studio',
      3 => 'Genesis Gaming',
      4 => 'Play n GO',
      5 => 'Cayetano Gaming',
      6 => '2By2 Gaming',
      7 => 'Quickspin',
      8 => 'Evolution Gaming',
      9 => 'Leander Games',
      10 => 'Games Warehouse',
      11 => 'NYX Interactive',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100% + 50 <abbr title="Free Spins"> FS',
      'min_deposit' => '€20',
      'wagering' => '35x(D+B)',
      'games_allowed' => 'All (FS - Starburst)',
      'code' => 'No code',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => NULL,
    'live_dealers' => NULL,
    'date_established' => '2014-01-01',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '1',
    'logo_big' => '/public/sync/casino_logo_light/124x82/no-logo-124x82.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/no-logo-85x56.png',
    'new' => false,
    'score_class' => 'No score',
    'all_softwares' => 'Felt Gaming, Multicommerce Game Studio, Genesis Gaming, Play n GO, Cayetano Gaming, 2By2 Gaming, Quickspin, Evolution Gaming, Leander Games, Games Warehouse, NYX Interactive',
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'Jan 01, 2014',
    'status' => '0',
  ),
  17 => 
  array (
    'id' => '972',
    'name' => 'Betadonis Casino',
    'code' => 'betadonis_casino',
    'rating' => 10,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'BetSoft',
      2 => 'Evolution Gaming',
      3 => 'Betgames TV',
      4 => 'BetConstruct',
      5 => 'Pragmatic Play',
      6 => 'XPG',
      7 => 'GameArt',
      8 => 'Playson',
      9 => 'Ezugi',
      10 => 'Quickspin',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100%',
      'min_deposit' => '$/€/£10',
      'wagering' => '45xB',
      'games_allowed' => 'All except Roulette,Baccarat & Live Casino',
      'code' => 'No code required',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => NULL,
    'live_dealers' => NULL,
    'date_established' => '2010-05-10',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '0',
    'logo_big' => '/public/sync/casino_logo_light/124x82/betadonis_casino.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/betadonis_casino.png',
    'new' => false,
    'score_class' => 'Excellent',
    'all_softwares' => 'BetSoft, Evolution Gaming, Betgames TV, BetConstruct, Pragmatic Play, XPG, GameArt, Playson, Ezugi, Quickspin',
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'May 10, 2010',
    'status' => '0',
  ),
  18 => 
  array (
    'id' => '936',
    'name' => 'Chitchat Bingo',
    'code' => 'chitchat_bingo',
    'rating' => 10,
    'softwares' => 
    array (
      0 => 'Dragonfish',
      1 => 'Pariplay',
      2 => 'Jadestone',
      3 => 'Evolution Gaming',
      4 => 'Amaya Gaming',
      5 => 'IGT',
      6 => 'NetEnt',
      7 => 'GGP',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '400% + 25 <abbr title="Free Spins"> FS',
      'min_deposit' => '$/€/£10',
      'wagering' => '80xB',
      'games_allowed' => 'All (FS - Fluffy Favourites)',
      'code' => 'No code required',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => NULL,
    'live_dealers' => NULL,
    'date_established' => '1997-01-01',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '0',
    'logo_big' => '/public/sync/casino_logo_light/124x82/chitchat_bingo.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/chitchat_bingo.png',
    'new' => false,
    'score_class' => 'Excellent',
    'all_softwares' => 'Pariplay, Jadestone, Evolution Gaming, Amaya Gaming, IGT, NetEnt, GGP',
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'Jan 01, 1997',
    'status' => '0',
  ),
  19 => 
  array (
    'id' => '243',
    'name' => 'NordicBet Casino',
    'code' => 'nordicbet_casino',
    'rating' => 6,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'WMS',
      2 => 'Play n GO',
      3 => 'Evolution Gaming',
      4 => 'MicroGaming',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100% + 25 <abbr title="Free Spins"> FS',
      'min_deposit' => '$/€10',
      'wagering' => '35xB',
      'games_allowed' => 'All',
      'code' => 'NB100',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => NULL,
    'live_dealers' => NULL,
    'date_established' => '2002-02-01',
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '1',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '0',
    'logo_big' => '/public/sync/casino_logo_light/124x82/nordicbet_casino.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/nordicbet_casino.png',
    'new' => false,
    'score_class' => 'Good',
    'all_softwares' => 'WMS, Play n GO, Evolution Gaming, MicroGaming',
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'Feb 01, 2002',
    'status' => '0',
  ),
  20 => 
  array (
    'id' => '1573',
    'name' => 'Mr Play Casino Abel',
    'code' => 'mrplay_casino_abel',
    'rating' => 10,
    'softwares' => 
    array (
      0 => 'Play n GO',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '100% + 20 <abbr title="Free Spins"> FS',
      'min_deposit' => '10£/€/$',
      'wagering' => '35xB',
      'games_allowed' => 'All except specified games',
      'code' => 'No code required',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => NULL,
    'live_dealers' => NULL,
    'date_established' => NULL,
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '1',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '1',
    'logo_big' => '/public/sync/casino_logo_light/124x82/no-logo-124x82.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/no-logo-85x56.png',
    'new' => true,
    'score_class' => 'Excellent',
    'all_softwares' => NULL,
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'None',
    'status' => '0',
  ),
  21 => 
  array (
    'id' => '1229',
    'name' => 'Thebes Casino',
    'code' => 'thebes_casino',
    'rating' => 6,
    'softwares' => 
    array (
      0 => 'Rival',
      1 => 'Dragonfish',
      2 => 'Pragmatic Play',
      3 => 'Parlay',
      4 => 'BetSoft',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '200%',
      'min_deposit' => '$10',
      'wagering' => '35x(D+B)',
      'games_allowed' => 'All',
      'code' => 'No code required',
      'type' => 'First Deposit Bonus',
      'bonus_type_Abbreviation' => NULL,
    ),
    'bonus_free' => 
    array (
      'amount' => '25',
      'min_deposit' => '',
      'wagering' => '75xB',
      'games_allowed' => 'Slots',
      'code' => 'No code required',
      'type' => 'Free Spins',
      'bonus_type_Abbreviation' => 'FS',
    ),
    'live_dealers' => NULL,
    'date_established' => NULL,
    'emails' => NULL,
    'phones' => NULL,
    'is_live_chat' => NULL,
    'licenses' => NULL,
    'certifiers' => NULL,
    'affiliate_program' => NULL,
    'affiliate_link' => NULL,
    'tc_link' => NULL,
    'withdrawal_minimum' => NULL,
    'withdrawal_limits' => NULL,
    'withdrawal_timeframes' => NULL,
    'deposit_methods' => NULL,
    'withdraw_methods' => NULL,
    'is_country_accepted' => '0',
    'is_language_accepted' => NULL,
    'email_link' => NULL,
    'is_currency_accepted' => NULL,
    'note' => NULL,
    'is_tc_link' => '0',
    'logo_big' => '/public/sync/casino_logo_light/124x82/thebes_casino.png',
    'logo_small' => '/public/sync/casino_logo_light/85x56/thebes_casino.png',
    'new' => true,
    'score_class' => 'Good',
    'all_softwares' => 'Dragonfish, Pragmatic Play, Parlay, BetSoft',
    'deposit_minimum' => NULL,
    'welcome_package' => NULL,
    'casino_deposit_methods' => NULL,
    'casino_game_types' => NULL,
    'date_formatted' => 'None',
    'status' => '0',
  ),
));
$this->response->attributes("page_type", 'live_dealer');
$this->response->attributes("bonus_free_type", array (
  0 => NULL,
  1 => NULL,
  2 => NULL,
  3 => NULL,
  4 => NULL,
  5 => NULL,
  6 => NULL,
  7 => NULL,
  8 => NULL,
  9 => 'FS',
  10 => NULL,
  11 => NULL,
  12 => NULL,
  13 => 'NDB',
  14 => NULL,
  15 => NULL,
  16 => NULL,
  17 => NULL,
  18 => NULL,
  19 => NULL,
  20 => NULL,
  21 => 'FS',
));
$this->response->attributes("page_info", array (
  'head_title' => 'Complete Live Roulette Casinos Directory 2020 | CasinosLists.com',
  'head_description' => 'Complete List of Live Roulette Casinos at CasinosLists.com! Join Real Players & Discover Live Dealer Roulette Games at the Best Live Roulette Casinos!',
  'body_title' => 'Live Roulette Casinos',
));
$this->response->attributes("version", '0.8.8.9129');
$this->response->attributes("use_bundle", true);
$this->response->attributes("tms", array (
  'upper_text' => '<p> </p>

<p>test upper</p>

<p>test upper</p>

<p>test upper</p>

<p>test upper</p>

<p>test upper</p>

<p><span class="dyna-var" id="foo">10</span></p>

<p><span class="dyna-var"><span class="dyna-var" id="foo">February 03, 2020</span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">100%</span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">400% + 25 <abbr title="Free Spins"> FS</span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">100% + 50 <abbr title="Free Spins"> FS<br />
<span class="dyna-var" id="foo">3</span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">699</span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo"></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">6296</span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">Majestic Sea</span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">test2</span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">Exotic Fruit Deluxe</span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">Exotic Fruit Deluxe</span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">NetEnt</span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">RTG</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">Booming Games</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">Booming Games</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">1187</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo"><a href="/reviews/react-casino-abel-review">React Casino Abel</a></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo"><a href="/reviews/lippie-casino-review">Lippie Casino</a></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">£10</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">10</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">£10</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">$/€25</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo"><a href="/reviews/betadonis-casino-review">Betadonis Casino</a></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo"><a href="/reviews/kozmo-casino-review">kozmo casino</a><br />
<span class="dyna-var" id="foo">22</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">Romania<br />
<span class="dyna-var" id="foo">0</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">160</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">42</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">2</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p> </p>
',
  'lower_text' => '<p>test lower</p>

<p>test lower</p>

<p>test lower</p>

<p>test lower</p>

<p>test lower</p>

<p><span class="dyna-var" id="foo">10</span></p>

<p><span class="dyna-var"><span class="dyna-var" id="foo">February 03, 2020</span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">100%</span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">400% + 25 <abbr title="Free Spins"> FS</span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">100% + 50 <abbr title="Free Spins"> FS<br />
<span class="dyna-var" id="foo">3</span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">699</span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo"></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">6296</span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">Majestic Sea</span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">test2</span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">Exotic Fruit Deluxe</span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">Exotic Fruit Deluxe</span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">NetEnt</span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">RTG</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">Booming Games</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">Booming Games</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">1187</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo"><a href="/reviews/react-casino-abel-review">React Casino Abel</a></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo"><a href="/reviews/lippie-casino-review">Lippie Casino</a></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">£10</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">10</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">£10</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">$/€25</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo"><a href="/reviews/betadonis-casino-review">Betadonis Casino</a></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo"><a href="/reviews/kozmo-casino-review">kozmo casino</a><br />
<span class="dyna-var" id="foo">22</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">Romania<br />
<span class="dyna-var" id="foo">0</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">160</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">42</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var"><span class="dyna-var" id="foo">2</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>

<p> </p>
',
));
$this->response->attributes("widgets", array (
  'upper' => 
  array (
    0 => '<p>test</p>
',
  ),
  'lower' => 
  array (
    0 => '<p><strong>WHAT ARE LIVE DEALER ROULETTE CASINOS?</strong><br />
<br />
<img src="https://www.casinoslists.com/upload/tms/roulette.jpg" style="display: block; margin-left: auto; margin-right: auto; width: 100%; height: 100%;" /><br />
If you&rsquo;ve always wanted to spice things up while playing this unique casino game online, live roulette gambling websites are the ones for you. That&rsquo;s because they collaborate with software providers to deliver high-quality streams and allow you to experience the land-based casino atmosphere without having to organize expensive trips to Vegas. So take a seat around a virtual table while a real live dealer runs the game for you, join other roulette fans and enjoy yourself! Take a quick peek at Evolution Gaming&rsquo;s Immersive Roulette presentation video below to see what&rsquo;s waiting for you:<br />
&nbsp;</p>

<p><iframe allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" frameborder="0" height="853" src="https://www.youtube.com/embed/WSG8mXOlB_A" width="100%"></iframe><br />
<strong>THE ADVANTAGES OF PLAYING AT LIVE DEALER ONLINE ROULETTE CASINOS</strong><br />
There&rsquo;s a lot to be mentioned here, but we&rsquo;ll keep the section short by mentioning only some of the key benefits of live roulette casinos:<br />
&nbsp;</p>

<ul>
	<li><strong>Realistic Casino Experience:</strong> If you opt for the live dealer version of roulette, you&rsquo;ll be able to join other real-life players and an actual dealer around a table designed to closely resemble those in actual casinos. Through high definition video and audio stream, you&rsquo;ll feel like you&rsquo;re right where the action happens!<br />
	&nbsp;</li>
	<li><strong>Maximum Transparency:</strong> You&rsquo;ll notice that the dealer will always explain every step of the game out loud, clearly. Their moves are also ample and meant to make everything clear and ensure you&rsquo;re able to follow the game closely. Furthermore, everything is designed to provide as much transparency as possible.<br />
	&nbsp;</li>
	<li><strong>Accessibility</strong>: Live dealer roulette casinos are accessible from anywhere, provided that you have a stable internet connection and decent device to play on. These days, you can opt for either desktop or <a href="https://www.casinoslists.com/casinos/mobile">mobile casinos</a> without having to sacrifice game quality.<br />
	&nbsp;</li>
</ul>

<p><strong>LIVE ROULETTE CASINO TIPS</strong><br />
If you&rsquo;re having a difficult time choosing from our extensive directory of gambling websites, here are some tips that will help you make the searching process easier:<br />
&nbsp;</p>

<ul>
	<li><strong>Pick a Reputable Live Roulette Casino:</strong> As you can see, each casino on our list has a certain rating. This represents the evaluation of our players&rsquo; community and can tell you a great deal about the quality of that gambling website. Pay attention to this detail when choosing your next playground and don&rsquo;t forget that being verified by authorities of the gambling world is an important aspect as well.<br />
	&nbsp;</li>
	<li><strong>Choose the Right Table for Your Budget:</strong> You can find live roulette tables for any pocket, from variants with really low bet limits to high roller ones. Once you&rsquo;ve established your budget for the gambling session, make sure to pick tables that are within your boundaries.<br />
	&nbsp;</li>
	<li><strong>Keep in Mind the Software Providers:</strong> Providers are extremely important, as they are the ones designing everything for the game. This means certain developers have their own approach and will give their products certain features to make them stand out from the crowd. You can keep in mind names such as <a href="https://www.casinoslists.com/softwares/netent">NetEnt</a> or <a href="https://www.casinoslists.com/softwares/evolution-gaming">Evolution Gaming</a>, which deliver high-end live dealer roulette solutions.</li>
</ul>

<p><strong>FREQUENTLY ASKED QUESTIONS<br />
<br />
Do live roulette casinos offer no deposit welcome bonuses?</strong><br />
Of course! As a matter of fact, you can use the Free bonus filter to see all the <span class="dyna-var" id="foo">3</span>&nbsp;live roulette casinos that will grant you a freebie upon registration, under the form of either free spins or free cash!<br />
<br />
<strong>Can I use any payment method to deposit and withdraw funds?</strong><br />
Well, it depends on the casino. Each site accepts a variety of payment options, which are displayed on its review page. Make sure to see if your banking method of choice is available for both deposits and withdrawals, as it will make your transactions much quicker in the future.<br />
<br />
<strong>Where can I find the best live dealer roulette casinos?</strong><br />
To see which are the best live roulette gambling sites, simply sort the list by <strong>Top Rated</strong>. This will enable you to see which are your top choices, according to our real players&rsquo; community.</p>
',
  ),
));

    }
}
        