<?php
class GamesByTypeController extends Controller {
    public function run() {
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
    'is_active' => true,
  ),
));
$this->response->setAttribute("selected_entity", 'Video Slots');
$this->response->setAttribute("menu_bottom", array (
  0 => 
  array (
    'title' => 'Video Slots',
    'url' => '/games/video-slots',
    'is_active' => true,
  ),
  1 => 
  array (
    'title' => 'Video Poker',
    'url' => '/games/video-poker',
    'is_active' => false,
  ),
  2 => 
  array (
    'title' => 'Classic Slots',
    'url' => '/games/classic-slots',
    'is_active' => false,
  ),
  3 => 
  array (
    'title' => 'Scratch Cards',
    'url' => '/games/scratch-cards',
    'is_active' => false,
  ),
  4 => 
  array (
    'title' => 'Blackjack',
    'url' => '/games/blackjack',
    'is_active' => false,
  ),
  5 => 
  array (
    'title' => 'Other',
    'url' => '/games/other',
    'is_active' => false,
  ),
  6 => 
  array (
    'title' => 'Roulette',
    'url' => '/games/roulette',
    'is_active' => false,
  ),
  7 => 
  array (
    'title' => 'Table Games',
    'url' => '/games/table-games',
    'is_active' => false,
  ),
  8 => 
  array (
    'title' => 'Keno',
    'url' => '/games/keno',
    'is_active' => false,
  ),
  9 => 
  array (
    'title' => 'Bingo',
    'url' => '/games/bingo',
    'is_active' => false,
  ),
  10 => 
  array (
    'title' => 'Baccarat',
    'url' => '/games/baccarat',
    'is_active' => false,
  ),
  11 => 
  array (
    'title' => 'Craps',
    'url' => '/games/craps',
    'is_active' => false,
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
  115 => 'NetoPlay',
  116 => 'NextGen Gaming',
  117 => 'Novomatic',
  118 => 'NuWorks',
  119 => 'NYX Interactive',
  120 => 'Octopus Gaming',
  121 => 'Odobo Gaming',
  122 => 'Omega Gaming',
  123 => 'OMI Gaming',
  124 => 'Ongame',
  125 => 'OpenBet',
  126 => 'Opus Gaming',
  127 => 'Oryx Gaming',
  128 => 'Pariplay',
  129 => 'Parlay',
  130 => 'Patagonia Entertainment',
  131 => 'Play n GO',
  132 => 'PlayPearls',
  133 => 'Playsoft',
  134 => 'Playson',
  135 => 'Playtech',
  136 => 'PopCap',
  137 => 'Portomaso Gaming',
  138 => 'Pragmatic Play',
  139 => 'ProgressPlay',
  140 => 'Push Gaming',
  141 => 'Quickfire',
  142 => 'Quickspin',
  143 => 'R Franco',
  144 => 'Rabcat',
  145 => 'RCT Gaming',
  146 => 'Realistic Games',
  147 => 'Relax Gaming',
  148 => 'Rival',
  149 => 'RTG',
  150 => 'Saber Interactive',
  151 => 'Saucify',
  152 => 'SBTech',
  153 => 'Scientific Games',
  154 => 'Side City Studios',
  155 => 'Skill On Net',
  156 => 'Skillzz Gaming',
  157 => 'Slotland Entertainment',
  158 => 'Soft Magic Dice',
  159 => 'SoftSwiss',
  160 => 'Spigo',
  161 => 'Spin3',
  162 => 'Spinomenal',
  163 => 'TAIN',
  164 => 'Takisto',
  165 => 'Thunderkick',
  166 => 'Tom Horn',
  167 => 'Tom Horn Gaming',
  168 => 'Top Game',
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
$this->response->setAttribute("total_games", 4525);
$this->response->setAttribute("games", array (
  6966 => 
  array (
    'id' => '6966',
    'name' => 'Planet Fortune',
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
  6965 => 
  array (
    'id' => '6965',
    'name' => 'Mighty Arthur',
    'type' => NULL,
    'software' => 'Quickspin',
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
  6964 => 
  array (
    'id' => '6964',
    'name' => 'Pied Piper',
    'type' => NULL,
    'software' => 'Quickspin',
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
  6962 => 
  array (
    'id' => '6962',
    'name' => 'Rapunzels Tower',
    'type' => NULL,
    'software' => 'Quickspin',
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
  6961 => 
  array (
    'id' => '6961',
    'name' => 'Grill King',
    'type' => NULL,
    'software' => 'Fugaso',
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
  6960 => 
  array (
    'id' => '6960',
    'name' => 'Gates of Hell',
    'type' => NULL,
    'software' => 'Fugaso',
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
  6959 => 
  array (
    'id' => '6959',
    'name' => 'Treasure of Shaman',
    'type' => NULL,
    'software' => 'Fugaso',
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
  6958 => 
  array (
    'id' => '6958',
    'name' => 'Sweet Paradise',
    'type' => NULL,
    'software' => 'Fugaso',
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
  6957 => 
  array (
    'id' => '6957',
    'name' => 'Sea Underwater Club',
    'type' => NULL,
    'software' => 'Fugaso',
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
  6956 => 
  array (
    'id' => '6956',
    'name' => 'Maniac House',
    'type' => NULL,
    'software' => 'Fugaso',
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
  6955 => 
  array (
    'id' => '6955',
    'name' => 'Lapland',
    'type' => NULL,
    'software' => 'Fugaso',
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
  6954 => 
  array (
    'id' => '6954',
    'name' => 'Gemstone of Aztec',
    'type' => NULL,
    'software' => 'Fugaso',
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
$this->response->setAttribute("page_info", array (
  'head_title' => 'Video Slots Games List | Play for Fun - 2018',
  'head_description' => 'Free Video Slots Games List | Play Video Slots Demo Games for Free! Full List of Video Slots Games at CasinosLists.com - 2018',
  'body_title' => 'Video Slots Games List February 2018',
));

    }
}
        