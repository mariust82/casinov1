<?php
class CasinosByLabelController extends Controller {
    public function run() {
        $this->response->setAttribute("country", array (
  'id' => '34',
  'code' => 'US',
  'name' => 'United States',
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
    'is_active' => true,
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
      'Classic Slots' => '/games/classic-slots',
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
$this->response->setAttribute("selected_entity", 'New');
$this->response->setAttribute("is_mobile", false);
$this->response->setAttribute("menu_bottom", array (
  0 => 
  array (
    'title' => 'United States Casinos',
    'url' => '/countries-list/united-states',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  1 => 
  array (
    'title' => 'No Deposit Casinos',
    'url' => '/bonus-list/no-deposit-bonus',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  2 => 
  array (
    'title' => 'Best Casinos',
    'url' => '/casinos/best',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  3 => 
  array (
    'title' => 'Mobile Casinos',
    'url' => '/casinos/mobile',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  4 => 
  array (
    'title' => 'New Casinos',
    'url' => '/casinos/new',
    'is_active' => true,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  5 => 
  array (
    'title' => 'Stay Away Casinos',
    'url' => '/casinos/stay-away',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  6 => 
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
$this->response->setAttribute("sort_criteria", 3);
$this->response->setAttribute("filter", 'label');
$this->response->setAttribute("total_casinos", '2');
$this->response->setAttribute("casinos", array (
  0 => 
  array (
    'id' => '1372',
    'name' => 'Bronze Casino',
    'code' => 'bronze_casino',
    'rating' => 0,
    'softwares' => 
    array (
      0 => 'NetEnt',
      1 => 'NextGen Gaming',
      2 => 'BetSoft',
      3 => 'Playson',
      4 => 'Play n GO',
      5 => 'Booming Games',
      6 => 'Spinomenal',
      7 => 'MrSlotty Games',
      8 => 'Fugaso',
      9 => 'Booongo',
    ),
    'languages' => NULL,
    'currencies' => NULL,
    'bonus_first_deposit' => 
    array (
      'amount' => '200% + 50 FS',
      'min_deposit' => '€20',
      'wagering' => '30x(D+B)',
      'games_allowed' => 'All (FS - Betsoft)',
      'code' => 'No code required',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => NULL,
    'is_live_dealer' => NULL,
    'date_established' => '2018-01-02',
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
    'note' => NULL,
    'invision_casino_id' => NULL,
    'date_formatted' => 'Jan. 02, 2018',
    'status' => '0',
  ),
  1 => 
  array (
    'id' => '1369',
    'name' => 'UpTown Pokies Casino',
    'code' => 'uptown_pokies_casino',
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
      'min_deposit' => '20 AU$',
      'wagering' => '35x(D+B)',
      'games_allowed' => 'Slots, Keno, Scratch Cards',
      'code' => 'POKIES1',
      'type' => 'First Deposit Bonus',
    ),
    'bonus_free' => 
    array (
      'amount' => '10 AU$',
      'min_deposit' => '',
      'wagering' => '60xB',
      'games_allowed' => 'Slots, Keno, Scratch Cards',
      'code' => 'GDAY10',
      'type' => 'No Deposit Bonus',
    ),
    'is_live_dealer' => NULL,
    'date_established' => '2017-12-19',
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
    'note' => NULL,
    'invision_casino_id' => NULL,
    'date_formatted' => 'Dec. 19, 2017',
    'status' => '0',
  ),
));
$this->response->setAttribute("page_info", array (
  'head_title' => 'New Online Casino Sites List - 2018',
  'head_description' => 'New  Online Casinos List | Full Information about all the New Online Casinos, CasinosLists.com is giving you only verified and updated details – 2018',
  'body_title' => 'New Online Casinos December 2018',
));
$this->response->setAttribute("version", '0.8.3.6');
$this->response->setAttribute("tms", array (
  'upper_text' => '<p><strong>Lorem ipsum</strong>&nbsp;is a pseudo-Latin text used in web design, typography, layout, and printing in place of English to emphasise design elements over content. It&#39;s also called placeholder (or filler) text. It&#39;s a convenient tool for mock-ups. It helps to outline the <a href="http://www.example.com">visual </a><strong>elements </strong>of a <em>document </em>or <u>presentation</u>, eg typography, font, or layout. Lorem ipsum is mostly a part of a Latin text by the classical author and philosopher Cicero. Its <strong>WO</strong>rdsandletters have been changed by addition or removal, so to deliberately render its content nonsensical; it&#39;s not genuine, correct, or comprehensible Latin anymore. While&nbsp;<strong>lorem ipsum</strong>&#39;s still resembles classical Latin, it actually has no meaning whatsoever. As Cicero&#39;s text doesn&#39;t contain the letters K, W, or Z, alien to latin, these, and others are often inserted randomly to mimic the typographic appearence of European languages, as are digraphs not to be found in the original.</p>

<p>In a professional context it often happens that private or corporate clients corder a publication to be made and presented with the actual content still not being ready. Think of a news blog that&#39;s filled with content hourly on the day of going live. However, reviewers tend to be distracted by comprehensible content, say, a random text copied from a newspaper or the internet. The are likely to focus on the text, disregarding the layout and its elements. Besides, random text risks to be unintendedly humorous or offensive, an unacceptable risk in corporate environments.&nbsp;<strong>Lorem ipsum</strong>&nbsp;and its many variants have been employed since the early 1960ies, and quite likely since the sixteenth century.</p>
',
));

    }
}
        