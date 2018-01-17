<?php
abstract class GamesListController extends Controller {
	public function run() {
		
$this->response->setAttribute("games", array (
  0 => 
  array (
    'id' => 10,
    'name' => 'random#2',
    'type' => 'random#2',
    'software' => 'random#8',
    'release_date' => 'random#9',
    'technologies' => 
    array (
      0 => 'random#6',
      1 => 'random#2',
      2 => 'random#6',
      3 => 'random#6',
      4 => 'random#8',
      5 => 'random#3',
      6 => 'random#4',
      7 => 'random#3',
      8 => 'random#6',
      9 => 'random#10',
    ),
    'is_mobile' => 0,
    'is_3d' => 0,
    'overview' => 'random#5',
    'times_played' => 2,
    'play' => 
    array (
      'status' => 'random#8',
      'pattern' => 'random#9',
      'match' => 'random#9',
    ),
  ),
));
$this->response->setAttribute("total_games", 7);
	}
}
