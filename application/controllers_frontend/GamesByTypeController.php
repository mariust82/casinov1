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
  7 => 'AliQuantum Gaming',
  8 => 'Allwilds',
  9 => 'Alps Games',
  10 => 'AlteaGaming',
  11 => 'Amatic Industries',
  12 => 'Amaya Gaming',
  13 => 'Amuzi Gaming',
  14 => 'Aristocrat',
  15 => 'Arrows Edge',
  16 => 'Ash Gaming',
  17 => 'Astra Games',
  18 => 'B3W',
  19 => 'Bally',
  20 => 'Barcrest Games',
  21 => 'Belatra Games',
  22 => 'BetConstruct',
  23 => 'Betdigital',
  24 => 'BetGames',
  25 => 'Betgames TV',
  26 => 'BetOnSoft',
  27 => 'BetSoft',
  28 => 'Big Time Gaming',
  29 => 'Bluberi Gaming',
  30 => 'Blueprint Gaming',
  31 => 'Bookie',
  32 => 'Booming Games',
  33 => 'Booongo',
  34 => 'Capecod Gaming',
  35 => 'Casino Technology',
  36 => 'CasinoSkillGaming',
  37 => 'Cassava Enterprise',
  38 => 'Cayetano Gaming',
  39 => 'CGTV Games',
  40 => 'Chance Interactive',
  41 => 'Core Gaming',
  42 => 'Cozy Games',
  43 => 'Cryptologic',
  44 => 'Daub Games',
  45 => 'Digital Gaming Solutions',
  46 => 'Dr Vegas Games',
  47 => 'Dragonfish',
  48 => 'Edict eGaming',
  49 => 'eGaming',
  50 => 'EGT',
  51 => 'Electracade',
  52 => 'ELK Studios',
  53 => 'Endemol Games',
  54 => 'Endorphina',
  55 => 'Espresso Games',
  56 => 'Euro Games Technology',
  57 => 'Eurocoin Interactive',
  58 => 'Ever Adventure',
  59 => 'Evolution Gaming',
  60 => 'Evoplay',
  61 => 'Eyecon',
  62 => 'Ezugi',
  63 => 'Felt Gaming',
  64 => 'Fremantle',
  65 => 'Fugaso',
  66 => 'GameArt',
  67 => 'Games OS',
  68 => 'Games Warehouse',
  69 => 'GameScale',
  70 => 'Gamesys',
  71 => 'Gamevy',
  72 => 'Gaminator',
  73 => 'GAMING1',
  74 => 'Gamomat',
  75 => 'GAN',
  76 => 'GDI',
  77 => 'Geco Gaming',
  78 => 'Genesis Gaming',
  79 => 'Genii',
  80 => 'GGL live',
  81 => 'GGP',
  82 => 'Global Gaming Labs',
  83 => 'GloboTech',
  84 => 'GreenTube',
  85 => 'GTS',
  86 => 'Habanero',
  87 => 'Habanero Systemss',
  88 => 'High 5 Games',
  89 => 'Holland Power Gaming',
  90 => 'Hybrino',
  91 => 'iGaming2Go',
  92 => 'Igrosoft',
  93 => 'IGSOnline',
  94 => 'IGT',
  95 => 'Incredible Technologies',
  96 => 'Infinity Gaming Solutions',
  97 => 'Ingenuity Gaming',
  98 => 'Inspired',
  99 => 'Instant Win Gaming',
  100 => 'Inteplay',
  101 => 'Intervision Gaming',
  102 => 'Intouch Games',
  103 => 'Iron Dog Studio',
  104 => 'iSoftBet',
  105 => 'Jadestone',
  106 => 'Join Games',
  107 => 'JPM Interactive',
  108 => 'JVH Gaming',
  109 => 'Kiron Interactive',
  110 => 'Leander Games',
  111 => 'Lightning Box Games',
  112 => 'LIONLINE',
  113 => 'Locus Gaming',
  114 => 'Logispin',
  115 => 'LuckyStreak',
  116 => 'Makitone Gaming',
  117 => 'Mazooma Interactive',
  118 => 'MediaLive',
  119 => 'Mega Jack',
  120 => 'Megadice',
  121 => 'Merkur Gaming',
  122 => 'MGA',
  123 => 'MicroGaming',
  124 => 'MrSlotty Games',
  125 => 'Multicommerce Game Studio',
  126 => 'Multislot',
  127 => 'Nektan',
  128 => 'NeoGames',
  129 => 'NetEnt',
  130 => 'NetoPlay',
  131 => 'NextGen Gaming',
  132 => 'Novomatic',
  133 => 'NuWorks',
  134 => 'NYX Interactive',
  135 => 'Octopus Gaming',
  136 => 'Odobo Gaming',
  137 => 'Omega Gaming',
  138 => 'OMI Gaming',
  139 => 'Ongame',
  140 => 'OpenBet',
  141 => 'Opus Gaming',
  142 => 'Oryx Gaming',
  143 => 'Pariplay',
  144 => 'Parlay',
  145 => 'Patagonia Entertainment',
  146 => 'Play n GO',
  147 => 'PlayPearls',
  148 => 'Playsoft',
  149 => 'Playson',
  150 => 'Playtech',
  151 => 'PopCap',
  152 => 'Portomaso Gaming',
  153 => 'Pragmatic Play',
  154 => 'ProgressPlay',
  155 => 'Push Gaming',
  156 => 'Quickfire',
  157 => 'Quickspin',
  158 => 'R Franco',
  159 => 'Rabcat',
  160 => 'RCT Gaming',
  161 => 'Realistic Games',
  162 => 'Relax Gaming',
  163 => 'Rival',
  164 => 'RTG',
  165 => 'Saber Interactive',
  166 => 'Saucify',
  167 => 'SBTech',
  168 => 'Scientific Games',
  169 => 'Sheriff Gaming',
  170 => 'Side City Studios',
  171 => 'Skill On Net',
  172 => 'Skillzz Gaming',
  173 => 'Slotland Entertainment',
  174 => 'Soft Magic Dice',
  175 => 'SoftSwiss',
  176 => 'Spielo G2',
  177 => 'Spigo',
  178 => 'Spin3',
  179 => 'Spinomenal',
  180 => 'TAIN',
  181 => 'Takisto',
  182 => 'The Art of Games',
  183 => 'Thunderkick',
  184 => 'Tom Horn',
  185 => 'Tom Horn Gaming',
  186 => 'Top Game',
  187 => 'UC8 Slots',
  188 => 'UltraPlay',
  189 => 'Unicum',
  190 => 'Viaden',
  191 => 'Virtue Fusion',
  192 => 'Visionary iGaming',
  193 => 'VistaGaming',
  194 => 'Vivo Gaming',
  195 => 'VueTec',
  196 => 'Wagermill',
  197 => 'WagerWorks',
  198 => 'Wazdan',
  199 => 'WGS',
  200 => 'White Hat Gaming',
  201 => 'Williams Interactive',
  202 => 'Win Interactive',
  203 => 'Wirex',
  204 => 'WMS Gaming',
  205 => 'World Match',
  206 => 'Xatronic Software',
  207 => 'xGames',
  208 => 'XPG',
  209 => 'Yggdrasil Gaming',
  210 => 'Zeus Services',
  211 => 'Zukido',
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

    }
}
        