<?php
class GamesByTypeController extends Controller {
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
$this->response->setAttribute("selected_entity", 'Baccarat');
$this->response->setAttribute("menu_bottom", array (
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
    'is_active' => true,
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
  0 => '1X2 Gaming',
  1 => '2By2 Gaming',
  2 => '888 Software',
  3 => 'Aberrant',
  4 => 'Ace Gaming',
  5 => 'Ainsworth',
  6 => 'Air Dice',
  7 => 'Allwilds',
  8 => 'Alps Games',
  9 => 'AlteaGaming',
  10 => 'Amatic Industries',
  11 => 'Amaya Gaming',
  12 => 'Amuzi Gaming',
  13 => 'Aristocrat',
  14 => 'Arrows Edge',
  15 => 'Ash Gaming',
  16 => 'Astra Games',
  17 => 'Bally',
  18 => 'Barcrest Games',
  19 => 'Belatra Games',
  20 => 'BetConstruct',
  21 => 'Betdigital',
  22 => 'BetGames',
  23 => 'Betgames TV',
  24 => 'BetOnSoft',
  25 => 'BetSoft',
  26 => 'Big Time Gaming',
  27 => 'Bluberi Gaming',
  28 => 'Blueprint Gaming',
  29 => 'Booming Games',
  30 => 'Booongo',
  31 => 'Capecod Gaming',
  32 => 'Casino Technology',
  33 => 'CasinoSkillGaming',
  34 => 'Cassava Enterprise',
  35 => 'Cayetano Gaming',
  36 => 'Chance Interactive',
  37 => 'Core Gaming',
  38 => 'Cozy Games',
  39 => 'Cryptologic',
  40 => 'Digital Gaming Solutions',
  41 => 'Dr Vegas Games',
  42 => 'Dragonfish',
  43 => 'Edict eGaming',
  44 => 'eGaming',
  45 => 'EGT',
  46 => 'Electracade',
  47 => 'ELK Studios',
  48 => 'Endemol Games',
  49 => 'Endorphina',
  50 => 'Evolution Gaming',
  51 => 'Evoplay',
  52 => 'Eyecon',
  53 => 'Ezugi',
  54 => 'Felt Gaming',
  55 => 'Fremantle',
  56 => 'Fugaso',
  57 => 'GameArt',
  58 => 'Games OS',
  59 => 'Games Warehouse',
  60 => 'GameScale',
  61 => 'Gamesys',
  62 => 'Gamevy',
  63 => 'Gaminator',
  64 => 'GAMING1',
  65 => 'Gamomat',
  66 => 'GAN',
  67 => 'GDI',
  68 => 'Geco Gaming',
  69 => 'Genesis Gaming',
  70 => 'Genii',
  71 => 'GGL live',
  72 => 'GGP',
  73 => 'Global Gaming Labs',
  74 => 'GloboTech',
  75 => 'GreenTube',
  76 => 'GTS',
  77 => 'Habanero',
  78 => 'Habanero Systemss',
  79 => 'High 5 Games',
  80 => 'Holland Power Gaming',
  81 => 'Hybrino',
  82 => 'iGaming2Go',
  83 => 'Igrosoft',
  84 => 'IGT',
  85 => 'Incredible Technologies',
  86 => 'Infinity Gaming Solutions',
  87 => 'Ingenuity Gaming',
  88 => 'Inspired',
  89 => 'Instant Win Gaming',
  90 => 'Inteplay',
  91 => 'Intervision Gaming',
  92 => 'Intouch Games',
  93 => 'Iron Dog Studio',
  94 => 'iSoftBet',
  95 => 'Jadestone',
  96 => 'Join Games',
  97 => 'JPM Interactive',
  98 => 'Kiron Interactive',
  99 => 'Leander Games',
  100 => 'Lightning Box Games',
  101 => 'LIONLINE',
  102 => 'Mazooma Interactive',
  103 => 'MediaLive',
  104 => 'Mega Jack',
  105 => 'Megadice',
  106 => 'Merkur Gaming',
  107 => 'MGA',
  108 => 'MicroGaming',
  109 => 'MrSlotty Games',
  110 => 'Multicommerce Game Studio',
  111 => 'Multislot',
  112 => 'Nektan',
  113 => 'NeoGames',
  114 => 'NetEnt',
  115 => 'NextGen Gaming',
  116 => 'Novomatic',
  117 => 'NuWorks',
  118 => 'NYX Interactive',
  119 => 'Octopus Gaming',
  120 => 'Odobo Gaming',
  121 => 'Omega Gaming',
  122 => 'OMI Gaming',
  123 => 'Ongame',
  124 => 'OpenBet',
  125 => 'Opus Gaming',
  126 => 'Oryx Gaming',
  127 => 'Pariplay',
  128 => 'Parlay',
  129 => 'Patagonia Entertainment',
  130 => 'Play n GO',
  131 => 'PlayPearls',
  132 => 'Playsoft',
  133 => 'Playson',
  134 => 'Playtech',
  135 => 'PopCap',
  136 => 'Portomaso Gaming',
  137 => 'Pragmatic Play',
  138 => 'ProgressPlay',
  139 => 'Push Gaming',
  140 => 'Quickfire',
  141 => 'Quickspin',
  142 => 'R Franco',
  143 => 'Rabcat',
  144 => 'RCT Gaming',
  145 => 'Realistic Games',
  146 => 'Relax Gaming',
  147 => 'Rival',
  148 => 'RTG',
  149 => 'Saber Interactive',
  150 => 'Saucify',
  151 => 'SBTech',
  152 => 'Scientific Games',
  153 => 'Side City Studios',
  154 => 'Skill On Net',
  155 => 'Skillzz Gaming',
  156 => 'Slotland Entertainment',
  157 => 'Soft Magic Dice',
  158 => 'SoftSwiss',
  159 => 'Spigo',
  160 => 'Spin3',
  161 => 'Spinomenal',
  162 => 'TAIN',
  163 => 'Takisto',
  164 => 'Thunderkick',
  165 => 'Tom Horn',
  166 => 'Tom Horn Gaming',
  167 => 'Top Game',
  168 => 'TwinoPlay',
  169 => 'UC8 Slots',
  170 => 'Unicum',
  171 => 'Viaden',
  172 => 'Virtue Fusion',
  173 => 'Visionary iGaming',
  174 => 'VistaGaming',
  175 => 'Vivo Gaming',
  176 => 'Wagermill',
  177 => 'WagerWorks',
  178 => 'Wazdan',
  179 => 'WGS',
  180 => 'White Hat Gaming',
  181 => 'Williams Interactive',
  182 => 'Win Interactive',
  183 => 'Wirex',
  184 => 'WMS Gaming',
  185 => 'World Match',
  186 => 'Xatronic Software',
  187 => 'xGames',
  188 => 'XPG',
  189 => 'Yggdrasil Gaming',
  190 => 'Zeus Services',
  191 => 'Zukido',
));
$this->response->setAttribute("filter", array (
));
$this->response->setAttribute("total_games", 33);
$this->response->setAttribute("games", array (
  6867 => 
  array (
    'id' => '6867',
    'name' => 'LuckyStreak Baccarat',
    'type' => NULL,
    'software' => 'LuckyStreak',
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
  6490 => 
  array (
    'id' => '6490',
    'name' => 'Digital Gaming Solutions Baccarat',
    'type' => NULL,
    'software' => 'Digital Gaming Solutions',
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
  6415 => 
  array (
    'id' => '6415',
    'name' => 'NuWorks Baccarat',
    'type' => NULL,
    'software' => 'NuWorks',
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
  6338 => 
  array (
    'id' => '6338',
    'name' => 'Visionary iGaming Baccarat',
    'type' => NULL,
    'software' => 'Visionary iGaming',
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
  6329 => 
  array (
    'id' => '6329',
    'name' => 'Takisto Baccarat Pro',
    'type' => NULL,
    'software' => 'Takisto',
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
  6328 => 
  array (
    'id' => '6328',
    'name' => 'Takisto Baccarat',
    'type' => NULL,
    'software' => 'Takisto',
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
  6293 => 
  array (
    'id' => '6293',
    'name' => '888 Software Baccarat',
    'type' => NULL,
    'software' => '888 Software',
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
  5257 => 
  array (
    'id' => '5257',
    'name' => 'Saucify Punto Banco',
    'type' => NULL,
    'software' => 'Saucify',
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
  5002 => 
  array (
    'id' => '5002',
    'name' => 'Baccarat Privee',
    'type' => NULL,
    'software' => 'World Match',
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
  4938 => 
  array (
    'id' => '4938',
    'name' => 'SoftSwiss Baccarat',
    'type' => NULL,
    'software' => 'SoftSwiss',
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
  4896 => 
  array (
    'id' => '4896',
    'name' => 'Skill On Net Baccarat',
    'type' => NULL,
    'software' => 'Skill On Net',
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
  4574 => 
  array (
    'id' => '4574',
    'name' => 'Tom Horn Gaming Baccarat',
    'type' => NULL,
    'software' => 'Tom Horn Gaming',
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
  4434 => 
  array (
    'id' => '4434',
    'name' => 'iSoftBet Punto Banco',
    'type' => NULL,
    'software' => 'iSoftBet',
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
  4265 => 
  array (
    'id' => '4265',
    'name' => 'VIP Multihand Baccarat',
    'type' => NULL,
    'software' => 'Games OS',
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
  4056 => 
  array (
    'id' => '4056',
    'name' => 'Pragmatic Play Baccarat',
    'type' => NULL,
    'software' => 'Pragmatic Play',
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
  3546 => 
  array (
    'id' => '3546',
    'name' => 'Bookie Baccarat',
    'type' => NULL,
    'software' => 'Bookie',
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
  2868 => 
  array (
    'id' => '2868',
    'name' => 'Baccarat Gold',
    'type' => NULL,
    'software' => 'MicroGaming',
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
  2699 => 
  array (
    'id' => '2699',
    'name' => 'Betsoft Baccarat',
    'type' => NULL,
    'software' => 'BetSoft',
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
  2665 => 
  array (
    'id' => '2665',
    'name' => 'Rival Baccarat',
    'type' => NULL,
    'software' => 'Rival',
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
  1980 => 
  array (
    'id' => '1980',
    'name' => '1X2Gaming Baccarat',
    'type' => NULL,
    'software' => '1X2 Gaming',
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
  1762 => 
  array (
    'id' => '1762',
    'name' => 'No Commission Baccarat',
    'type' => NULL,
    'software' => 'Amaya Gaming',
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
  1695 => 
  array (
    'id' => '1695',
    'name' => 'Amaya Gaming Baccarat',
    'type' => NULL,
    'software' => 'Amaya Gaming',
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
  1545 => 
  array (
    'id' => '1545',
    'name' => 'Mini Baccarat Mobile',
    'type' => NULL,
    'software' => 'Play n GO',
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
  1473 => 
  array (
    'id' => '1473',
    'name' => 'Mini Baccarat',
    'type' => NULL,
    'software' => 'Play n GO',
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
));
$this->response->setAttribute("page_info", array (
  'head_title' => 'Baccarat Games List | Play for Fun - 2018',
  'head_description' => 'Free Baccarat Games List | Play Baccarat Demo Games for Free! Full List of Baccarat Games at CasinosLists.com - 2018',
  'body_title' => 'Baccarat Games List December 2018',
));
$this->response->setAttribute("version", '0.8.3.6');

    }
}
        