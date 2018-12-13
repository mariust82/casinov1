<?php
class GameTypesController extends Controller {
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
    'is_active' => true,
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
$this->response->setAttribute("results", array (
  'Video Slots' => '4360',
  'Video Poker' => '464',
  'Classic Slots' => '421',
  'Scratch Cards' => '281',
  'Blackjack' => '188',
  'Other' => '160',
  'Roulette' => '154',
  'Table Games' => '123',
  'Keno' => '46',
  'Baccarat' => '39',
  'Bingo' => '35',
  'Craps' => '13',
));
$this->response->setAttribute("page_info", array (
  'head_title' => 'Casino Games Categories | Slots, Blackjack, Roulette and more',
  'head_description' => 'The complete list of online casino games types. With so many games available, we divided them into categories. Play Video Slots, Blackjack, Roulette & more',
  'body_title' => 'Casino Games Types',
));
$this->response->setAttribute("version", '0.8.3.7');
$this->response->setAttribute("tms", array (
  'upper_text' => '<p>Total number of games on site :&nbsp;6284</p>

<p>Total number of games in the current list:&nbsp;</p>

<p>Newest game on site&nbsp;&nbsp;:&nbsp;&nbsp;AmosTest2</p>

<p>Newest game in the current list :&nbsp;</p>

<p>Software of the newest game on site :&nbsp;1X2 Gaming</p>

<p>Software of the newest game in the current list&nbsp;:&nbsp;</p>

<p>Most popular game on site :&nbsp;Exotic Fruit Deluxe</p>

<p>Most popular game in the current list:&nbsp;</p>

<p>Software of the most popular game on site&nbsp;:&nbsp;Booming Games</p>

<p>Software of the most popular game in the current list&nbsp;:&nbsp;</p>

<p>games - update</p>

<p><b>0</b></p>

<p><strong>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</strong></p>
',
));

    }
}
        