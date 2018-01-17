<?php
/*
* Game info by game name.
* 
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/6735bd8e-75bb-415b-8204-66d6dca9122f/Single-Game-Page?fullscreen
* @pathParameter name string Name of game
*/
class GameInfoController extends Controller {
	public function run() {
		
$this->response->setAttribute("game", array (
  'id' => 7,
  'name' => 'random#10',
  'type' => 'random#10',
  'software' => 'random#1',
  'release_date' => 'random#9',
  'technologies' => 
  array (
    0 => 'random#8',
    1 => 'random#9',
    2 => 'random#7',
    3 => 'random#8',
    4 => 'random#10',
    5 => 'random#9',
    6 => 'random#5',
    7 => 'random#9',
    8 => 'random#5',
    9 => 'random#7',
  ),
  'is_mobile' => 0,
  'is_3d' => 1,
  'overview' => 'random#4',
  'times_played' => 6,
  'play' => 
  array (
    'status' => 'random#4',
    'pattern' => 'random#7',
    'match' => 'random#2',
  ),
));
$this->response->setAttribute("recommended_casinos", array (
  0 => 
  array (
    'id' => 4,
    'name' => 'random#1',
    'rating' => 4,
    'is_accepted' => 1,
    'softwares' => 
    array (
      0 => 'random#3',
      1 => 'random#1',
      2 => 'random#6',
      3 => 'random#1',
      4 => 'random#7',
      5 => 'random#2',
      6 => 'random#10',
      7 => 'random#7',
      8 => 'random#3',
      9 => 'random#9',
    ),
    'bonus_first_deposit' => 
    array (
      'amount' => 'random#5',
      'min_deposit' => 'random#1',
      'wagering' => 'random#6',
      'games_allowed' => 
      array (
        0 => 'random#3',
        1 => 'random#1',
        2 => 'random#4',
        3 => 'random#8',
        4 => 'random#9',
        5 => 'random#9',
        6 => 'random#4',
        7 => 'random#2',
        8 => 'random#8',
        9 => 'random#8',
      ),
      'code' => 'random#8',
    ),
    'bonus_free' => 
    array (
      'amount' => 'random#1',
      'min_deposit' => 'random#5',
      'wagering' => 'random#9',
      'games_allowed' => 
      array (
        0 => 'random#4',
        1 => 'random#5',
        2 => 'random#2',
        3 => 'random#2',
        4 => 'random#7',
        5 => 'random#3',
        6 => 'random#8',
        7 => 'random#8',
        8 => 'random#10',
        9 => 'random#10',
      ),
      'code' => 'random#7',
    ),
    'languages' => 
    array (
      0 => 'random#7',
      1 => 'random#3',
      2 => 'random#6',
      3 => 'random#1',
      4 => 'random#3',
      5 => 'random#1',
      6 => 'random#3',
      7 => 'random#4',
      8 => 'random#5',
      9 => 'random#10',
    ),
    'currencies' => 
    array (
      0 => 'random#3',
      1 => 'random#3',
      2 => 'random#4',
      3 => 'random#5',
      4 => 'random#1',
      5 => 'random#1',
      6 => 'random#2',
      7 => 'random#2',
      8 => 'random#5',
      9 => 'random#10',
    ),
    'is_live_dealer' => 0,
    'date_established' => '2018-01-17 15:37:12',
    'emails' => 
    array (
      0 => 'random#10',
      1 => 'random#2',
      2 => 'random#7',
      3 => 'random#6',
      4 => 'random#4',
      5 => 'random#4',
      6 => 'random#3',
      7 => 'random#4',
      8 => 'random#3',
      9 => 'random#10',
    ),
    'phones' => 
    array (
      0 => 'random#10',
      1 => 'random#5',
      2 => 'random#6',
      3 => 'random#10',
      4 => 'random#8',
      5 => 'random#7',
      6 => 'random#3',
      7 => 'random#2',
      8 => 'random#2',
      9 => 'random#3',
    ),
    'is_live_chat' => 0,
    'licenses' => 
    array (
      0 => 'random#4',
      1 => 'random#7',
      2 => 'random#8',
      3 => 'random#5',
      4 => 'random#7',
      5 => 'random#9',
      6 => 'random#6',
      7 => 'random#2',
      8 => 'random#9',
      9 => 'random#1',
    ),
    'certifiers' => 
    array (
      0 => 'random#1',
      1 => 'random#1',
      2 => 'random#7',
      3 => 'random#7',
      4 => 'random#4',
      5 => 'random#10',
      6 => 'random#10',
      7 => 'random#7',
      8 => 'random#3',
      9 => 'random#10',
    ),
    'affiliate_program' => 'random#7',
    'withdrawal_minimum' => 'random#7',
    'withdrawal_limits' => 
    array (
      0 => 'random#6',
      1 => 'random#6',
      2 => 'random#5',
      3 => 'random#2',
      4 => 'random#9',
      5 => 'random#6',
      6 => 'random#3',
      7 => 'random#2',
      8 => 'random#9',
      9 => 'random#7',
    ),
    'withdrawal_timeframes' => 
    array (
      0 => 'random#8',
      1 => 'random#7',
      2 => 'random#1',
      3 => 'random#5',
      4 => 'random#5',
      5 => 'random#7',
      6 => 'random#6',
      7 => 'random#4',
      8 => 'random#7',
      9 => 'random#7',
    ),
    'deposit_methods' => 
    array (
      0 => 'random#4',
      1 => 'random#3',
      2 => 'random#4',
      3 => 'random#8',
      4 => 'random#3',
      5 => 'random#3',
      6 => 'random#5',
      7 => 'random#5',
      8 => 'random#3',
      9 => 'random#1',
    ),
    'withdraw_methods' => 
    array (
      0 => 'random#2',
      1 => 'random#8',
      2 => 'random#7',
      3 => 'random#7',
      4 => 'random#9',
      5 => 'random#5',
      6 => 'random#2',
      7 => 'random#2',
      8 => 'random#7',
      9 => 'random#1',
    ),
  ),
));
$this->response->setAttribute("recommended_games", array (
  0 => 
  array (
    'id' => 8,
    'name' => 'random#4',
    'type' => 'random#7',
    'software' => 'random#9',
    'release_date' => 'random#8',
    'technologies' => 
    array (
      0 => 'random#2',
      1 => 'random#5',
      2 => 'random#4',
      3 => 'random#6',
      4 => 'random#2',
      5 => 'random#1',
      6 => 'random#9',
      7 => 'random#4',
      8 => 'random#4',
      9 => 'random#7',
    ),
    'is_mobile' => 1,
    'is_3d' => 1,
    'overview' => 'random#1',
    'times_played' => 2,
    'play' => 
    array (
      'status' => 'random#9',
      'pattern' => 'random#1',
      'match' => 'random#4',
    ),
  ),
));
	}
}
