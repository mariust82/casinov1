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
$this->response->setAttribute("game_types", array (
  0 => 'Video Slots',
  1 => 'Video Poker',
  2 => 'Classic Slots',
  3 => 'Scratch Cards',
  4 => 'Blackjack',
  5 => 'Other',
  6 => 'Roulette',
  7 => 'Table Games',
  8 => 'Keno',
  9 => 'Bingo',
  10 => 'Baccarat',
  11 => 'Craps',
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
  6953 => 
  array (
    'id' => '6953',
    'name' => 'Forest Ant',
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
  6952 => 
  array (
    'id' => '6952',
    'name' => 'Cheerful Farmer',
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
  6946 => 
  array (
    'id' => '6946',
    'name' => 'Bird of Thunder',
    'type' => NULL,
    'software' => 'Habanero',
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
  6945 => 
  array (
    'id' => '6945',
    'name' => 'Panda Panda',
    'type' => NULL,
    'software' => 'Habanero',
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
  6944 => 
  array (
    'id' => '6944',
    'name' => 'The Dead Escape',
    'type' => NULL,
    'software' => 'Habanero',
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
  6943 => 
  array (
    'id' => '6943',
    'name' => 'Scruffy Scallywags',
    'type' => NULL,
    'software' => 'Habanero',
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
  6942 => 
  array (
    'id' => '6942',
    'name' => 'Cake Valley',
    'type' => NULL,
    'software' => 'Habanero',
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
  6941 => 
  array (
    'id' => '6941',
    'name' => 'Rolling Roger',
    'type' => NULL,
    'software' => 'Habanero',
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
  6940 => 
  array (
    'id' => '6940',
    'name' => 'Santas Village',
    'type' => NULL,
    'software' => 'Habanero',
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
  6939 => 
  array (
    'id' => '6939',
    'name' => '5 Mariachis',
    'type' => NULL,
    'software' => 'Habanero',
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
  6937 => 
  array (
    'id' => '6937',
    'name' => 'Wizard Shop',
    'type' => NULL,
    'software' => 'Push Gaming',
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
  6936 => 
  array (
    'id' => '6936',
    'name' => 'Dragon Sisters',
    'type' => NULL,
    'software' => 'Push Gaming',
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
        