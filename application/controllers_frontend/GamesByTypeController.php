<?php
class GamesByTypeController extends Controller {
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
$this->response->setAttribute("selected_entity", 'Video Slots');
$this->response->setAttribute("menu_bottom", array (
  0 => 
  array (
    'title' => 'Video Slots',
    'url' => '/games/video-slots',
    'is_active' => true,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  1 => 
  array (
    'title' => 'Video Poker',
    'url' => '/games/video-poker',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  2 => 
  array (
    'title' => 'Classic Slots',
    'url' => '/games/classic-slots',
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
    'title' => 'Other',
    'url' => '/games/other',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  6 => 
  array (
    'title' => 'Roulette',
    'url' => '/games/roulette',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  7 => 
  array (
    'title' => 'Table Games',
    'url' => '/games/table-games',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  8 => 
  array (
    'title' => 'Keno',
    'url' => '/games/keno',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  9 => 
  array (
    'title' => 'Baccarat',
    'url' => '/games/baccarat',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  10 => 
  array (
    'title' => 'Bingo',
    'url' => '/games/bingo',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
  11 => 
  array (
    'title' => 'Craps',
    'url' => '/games/craps',
    'is_active' => false,
    'submenuItems' => 
    array (
    ),
    'have_submenu' => false,
  ),
));
$this->response->setAttribute("software", array (
  0 => '021 test',
  1 => '1test233',
  2 => '1X2 Gaming',
  3 => '21GNET',
  4 => '2By2 Gaming',
  5 => '888 Software',
  6 => 'Aberrant',
  7 => 'Ace Gaming',
  8 => 'Actual Gaming',
  9 => 'Ainsworth',
  10 => 'Air Dice',
  11 => 'AliQuantum Gaming',
  12 => 'Allwilds',
  13 => 'Alps Games',
  14 => 'AlteaGaming',
  15 => 'Amatic Industries',
  16 => 'Amaya Gaming',
  17 => 'Amuzi Gaming',
  18 => 'Aristocrat',
  19 => 'Arrows Edge',
  20 => 'Ash Gaming',
  21 => 'Bally',
  22 => 'Barcrest Games',
  23 => 'Belatra Games',
  24 => 'BetConstruct',
  25 => 'Betdigital',
  26 => 'BetGames',
  27 => 'Betgames TV',
  28 => 'BetOnSoft',
  29 => 'BetSoft',
  30 => 'Big Time Gaming',
  31 => 'Bluberi Gaming',
  32 => 'Blueprint Gaming',
  33 => 'Bookie',
  34 => 'Booming Games',
  35 => 'Capecod Gaming',
  36 => 'Casino Technology',
  37 => 'CasinoSkillGaming',
  38 => 'Cassava Enterprise',
  39 => 'Cayetano Gaming',
  40 => 'Chance Interactive',
  41 => 'Core Gaming',
  42 => 'Cozy Games',
  43 => 'Cryptologic',
  44 => 'Digital Gaming Solutions',
  45 => 'Dr Vegas Games',
  46 => 'Dragonfish',
  47 => 'Edict eGaming',
  48 => 'eGaming',
  49 => 'EGT',
  50 => 'Electracade',
  51 => 'ELK Studios',
  52 => 'Endemol Games',
  53 => 'Endorphina',
  54 => 'Evolution Gaming',
  55 => 'Evoplay',
  56 => 'Eyecon',
  57 => 'Ezugi',
  58 => 'Felt Gaming',
  59 => 'Fremantle',
  60 => 'GameArt',
  61 => 'Games OS',
  62 => 'Games Warehouse',
  63 => 'GameScale',
  64 => 'Gamesys',
  65 => 'Gamevy',
  66 => 'Gaminator',
  67 => 'GAMING1',
  68 => 'GAN',
  69 => 'GDI',
  70 => 'Geco Gaming',
  71 => 'Genesis Gaming',
  72 => 'Genii',
  73 => 'GGL live',
  74 => 'GGP',
  75 => 'Global Gaming Labs',
  76 => 'GloboTech',
  77 => 'GreenTube',
  78 => 'GTS',
  79 => 'Habanero',
  80 => 'Habanero Systems',
  81 => 'Habanero Systemss',
  82 => 'High 5 Games',
  83 => 'Holland Power Gaming',
  84 => 'Hybrino',
  85 => 'iGaming2Go',
  86 => 'Igrosoft',
  87 => 'IGT',
  88 => 'Incredible Technologies',
  89 => 'Infinity Gaming Solutions',
  90 => 'Ingenuity Gaming',
  91 => 'Instant Win Gaming',
  92 => 'Inteplay',
  93 => 'Intervision Gaming',
  94 => 'Intouch Games',
  95 => 'Iron Dog Studio',
  96 => 'iSoftBet',
  97 => 'Jadestone',
  98 => 'Join Games',
  99 => 'JPM Interactive',
  100 => 'Kiron Interactive',
  101 => 'Leander Games',
  102 => 'Lightning Box Games',
  103 => 'LIONLINE',
  104 => 'Mazooma Interactive',
  105 => 'MediaLive',
  106 => 'Mega Jack',
  107 => 'Megadice',
  108 => 'Merkur Gaming',
  109 => 'MGA',
  110 => 'MicroGaming',
  111 => 'MrSlotty Games',
  112 => 'Multicommerce Game Studio',
  113 => 'Multislot',
  114 => 'Nektan',
  115 => 'NeoGames',
  116 => 'NetEnt',
  117 => 'NetoPlay',
  118 => 'NextGen Gaming',
  119 => 'Novomatic',
  120 => 'NuWorks',
  121 => 'NYX Interactive',
  122 => 'Octopus Gaming',
  123 => 'Odobo Gaming',
  124 => 'Omega Gaming',
  125 => 'OMI Gaming',
  126 => 'Ongame',
  127 => 'OpenBet',
  128 => 'Opus Gaming',
  129 => 'Oryx Gaming',
  130 => 'Pariplay',
  131 => 'Parlay',
  132 => 'Patagonia Entertainment',
  133 => 'Play n GO',
  134 => 'PlayPearls',
  135 => 'Playsoft',
  136 => 'Playson',
  137 => 'Playtech',
  138 => 'PopCap',
  139 => 'Portomaso Gaming',
  140 => 'Pragmatic Play',
  141 => 'Pragmatic Play1',
  142 => 'ProgressPlay',
  143 => 'Push Gaming',
  144 => 'Quickfire',
  145 => 'Quickspin',
  146 => 'R Franco',
  147 => 'Rabcat',
  148 => 'RCT Gaming',
  149 => 'Realistic Games',
  150 => 'Relax Gaming',
  151 => 'Rival',
  152 => 'RTG',
  153 => 'Saber Interactive',
  154 => 'Saucify',
  155 => 'SBTech',
  156 => 'Scientific Games',
  157 => 'Side City Studios',
  158 => 'Skill On Net',
  159 => 'Skillzz Gaming',
  160 => 'Slotland Entertainment',
  161 => 'Soft Magic Dice',
  162 => 'SoftSwiss',
  163 => 'Spielo G2',
  164 => 'Spigo',
  165 => 'Spin3',
  166 => 'Spinomenal',
  167 => 'TAIN',
  168 => 'Takisto',
  169 => 'Thunderkick',
  170 => 'Tom Horn',
  171 => 'Tom Horn Gaming',
  172 => 'UC8 Slots',
  173 => 'Unicum',
  174 => 'Viaden',
  175 => 'Virtue Fusion',
  176 => 'Visionary iGaming',
  177 => 'VistaGaming',
  178 => 'Vivo Gaming',
  179 => 'Wagermill',
  180 => 'WagerWorks',
  181 => 'Wazdan',
  182 => 'WGS',
  183 => 'White Hat Gaming',
  184 => 'Williams Interactive',
  185 => 'Win Interactive',
  186 => 'Wirex',
  187 => 'WMS',
  188 => 'WMS Gaming',
  189 => 'World Match',
  190 => 'Xatronic Software',
  191 => 'xGames',
  192 => 'XPG',
  193 => 'Yggdrasil Gaming',
  194 => 'Zeus Services',
  195 => 'Zukido',
));
$this->response->setAttribute("filter", array (
));
$this->response->setAttribute("total_games", 4360);
$this->response->setAttribute("games", array (
  7268 => 
  array (
    'id' => '7268',
    'name' => 'Exotic Fruit Deluxe',
    'type' => NULL,
    'software' => 'Booming Games',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '59',
    'play' => NULL,
  ),
  7263 => 
  array (
    'id' => '7263',
    'name' => 'Goddess of the Amazon',
    'type' => NULL,
    'software' => 'Inspired',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7262 => 
  array (
    'id' => '7262',
    'name' => 'Inspired Centurion',
    'type' => NULL,
    'software' => 'Inspired',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7261 => 
  array (
    'id' => '7261',
    'name' => 'White Knight',
    'type' => NULL,
    'software' => 'Inspired',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7260 => 
  array (
    'id' => '7260',
    'name' => 'Inspired Monster Cash',
    'type' => NULL,
    'software' => 'Inspired',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7259 => 
  array (
    'id' => '7259',
    'name' => 'Inspired Diamond Goddess',
    'type' => NULL,
    'software' => 'Inspired',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7258 => 
  array (
    'id' => '7258',
    'name' => 'Inspired Treasure Island',
    'type' => NULL,
    'software' => 'Inspired',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7257 => 
  array (
    'id' => '7257',
    'name' => 'Which Witch',
    'type' => NULL,
    'software' => 'Intouch Games',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7256 => 
  array (
    'id' => '7256',
    'name' => 'Viking Storm',
    'type' => NULL,
    'software' => 'Intouch Games',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7255 => 
  array (
    'id' => '7255',
    'name' => 'Vegas Vegas',
    'type' => NULL,
    'software' => 'Intouch Games',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7254 => 
  array (
    'id' => '7254',
    'name' => 'Sweet King',
    'type' => NULL,
    'software' => 'Intouch Games',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7253 => 
  array (
    'id' => '7253',
    'name' => 'Space Katz',
    'type' => NULL,
    'software' => 'Intouch Games',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7252 => 
  array (
    'id' => '7252',
    'name' => 'Sherlock Murdered To Death',
    'type' => NULL,
    'software' => 'Intouch Games',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7251 => 
  array (
    'id' => '7251',
    'name' => 'Robins Reels',
    'type' => NULL,
    'software' => 'Intouch Games',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7250 => 
  array (
    'id' => '7250',
    'name' => 'Quest For Fire',
    'type' => NULL,
    'software' => 'Intouch Games',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7249 => 
  array (
    'id' => '7249',
    'name' => 'Pirates Treasure',
    'type' => NULL,
    'software' => 'Intouch Games',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7248 => 
  array (
    'id' => '7248',
    'name' => 'Mucho Money',
    'type' => NULL,
    'software' => 'Intouch Games',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7247 => 
  array (
    'id' => '7247',
    'name' => 'Intouch Games Monte Carlo',
    'type' => NULL,
    'software' => 'Intouch Games',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7246 => 
  array (
    'id' => '7246',
    'name' => 'Intouch Games Snakes and Ladders',
    'type' => NULL,
    'software' => 'Intouch Games',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7244 => 
  array (
    'id' => '7244',
    'name' => 'Mammoth Money',
    'type' => NULL,
    'software' => 'Intouch Games',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7243 => 
  array (
    'id' => '7243',
    'name' => 'Little Red Riding Reels',
    'type' => NULL,
    'software' => 'Intouch Games',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7241 => 
  array (
    'id' => '7241',
    'name' => 'Hansel And Gretel',
    'type' => NULL,
    'software' => 'Intouch Games',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7240 => 
  array (
    'id' => '7240',
    'name' => 'Gold Macdonald',
    'type' => NULL,
    'software' => 'Intouch Games',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
  7239 => 
  array (
    'id' => '7239',
    'name' => 'Gold Blast',
    'type' => NULL,
    'software' => 'Intouch Games',
    'release_date' => NULL,
    'technologies' => 
    array (
    ),
    'is_mobile' => NULL,
    'is_3d' => NULL,
    'overview' => NULL,
    'times_played' => '0',
    'play' => NULL,
  ),
));
$this->response->setAttribute("tms", array (
  'upper_text' => '<p><b>Total number of games on site :&nbsp;6284</b></p>

<p><b>Total number of games in the current list:&nbsp;4360</b></p>

<p><b>Newest game on site&nbsp;&nbsp;:&nbsp;&nbsp;AmosTest2</b></p>

<p><b>Newest game in the current list :&nbsp;Exotic Fruit Deluxe</b></p>

<p><b>Software of the newest game on site :&nbsp;1X2 Gaming</b></p>

<p><b>Software of the newest game in the current list&nbsp;:&nbsp;Booming Games</b></p>

<p><b>Most popular game on site :&nbsp;Exotic Fruit Deluxe</b></p>

<p><b>Most popular game in the current list:&nbsp;Exotic Fruit Deluxe</b></p>

<p><b>Software of the most popular game on site&nbsp;:&nbsp;Booming Games</b></p>

<p><b>Software of the most popular game in the current list&nbsp;:&nbsp;Booming Games</b></p>
',
));
$this->response->setAttribute("page_info", array (
  'head_title' => ' Play Video Slots Games for Free | Full List at CasinosLists.com',
  'head_description' => 'Play 4360 Video Slots Games for free at CasinosLists.com | Catch up with all Video Slots games releases from major online casino software developers.',
  'body_title' => 'Free Online Video Slots Games',
));
$this->response->setAttribute("version", '0.8.3.7');

    }
}
        