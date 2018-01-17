<?php
/*
* Info/review page of casino
* 
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/2ac8aa9a-cd45-4dd5-a9ca-4cd88dc4e291/Casino-Review-Page?fullscreen
* @pathParameter name string Name of casino
*/
class CasinoInfoController extends Controller {
	public function run() {
		
$this->response->setAttribute("country", 'random#8');
$this->response->setAttribute("casino", array (
  'id' => 10,
  'name' => 'random#5',
  'rating' => 3,
  'is_accepted' => 0,
  'softwares' => 
  array (
    0 => 'random#7',
    1 => 'random#9',
    2 => 'random#2',
    3 => 'random#5',
    4 => 'random#3',
    5 => 'random#9',
    6 => 'random#3',
    7 => 'random#10',
    8 => 'random#1',
    9 => 'random#8',
  ),
  'bonus_first_deposit' => 
  array (
    'amount' => 'random#4',
    'min_deposit' => 'random#6',
    'wagering' => 'random#9',
    'games_allowed' => 
    array (
      0 => 'random#4',
      1 => 'random#5',
      2 => 'random#3',
      3 => 'random#7',
      4 => 'random#1',
      5 => 'random#10',
      6 => 'random#3',
      7 => 'random#1',
      8 => 'random#2',
      9 => 'random#2',
    ),
    'code' => 'random#2',
  ),
  'bonus_free' => 
  array (
    'amount' => 'random#5',
    'min_deposit' => 'random#7',
    'wagering' => 'random#10',
    'games_allowed' => 
    array (
      0 => 'random#5',
      1 => 'random#2',
      2 => 'random#2',
      3 => 'random#6',
      4 => 'random#9',
      5 => 'random#10',
      6 => 'random#8',
      7 => 'random#3',
      8 => 'random#2',
      9 => 'random#6',
    ),
    'code' => 'random#6',
  ),
  'languages' => 
  array (
    0 => 'random#2',
    1 => 'random#7',
    2 => 'random#4',
    3 => 'random#6',
    4 => 'random#2',
    5 => 'random#3',
    6 => 'random#9',
    7 => 'random#7',
    8 => 'random#6',
    9 => 'random#6',
  ),
  'currencies' => 
  array (
    0 => 'random#7',
    1 => 'random#5',
    2 => 'random#9',
    3 => 'random#8',
    4 => 'random#6',
    5 => 'random#10',
    6 => 'random#10',
    7 => 'random#1',
    8 => 'random#7',
    9 => 'random#9',
  ),
  'is_live_dealer' => 0,
  'date_established' => '2018-01-17 15:37:12',
  'emails' => 
  array (
    0 => 'random#9',
    1 => 'random#10',
    2 => 'random#10',
    3 => 'random#7',
    4 => 'random#10',
    5 => 'random#7',
    6 => 'random#9',
    7 => 'random#2',
    8 => 'random#3',
    9 => 'random#5',
  ),
  'phones' => 
  array (
    0 => 'random#4',
    1 => 'random#10',
    2 => 'random#8',
    3 => 'random#9',
    4 => 'random#2',
    5 => 'random#10',
    6 => 'random#8',
    7 => 'random#8',
    8 => 'random#5',
    9 => 'random#4',
  ),
  'is_live_chat' => 0,
  'licenses' => 
  array (
    0 => 'random#9',
    1 => 'random#2',
    2 => 'random#2',
    3 => 'random#5',
    4 => 'random#2',
    5 => 'random#1',
    6 => 'random#5',
    7 => 'random#8',
    8 => 'random#10',
    9 => 'random#9',
  ),
  'certifiers' => 
  array (
    0 => 'random#6',
    1 => 'random#9',
    2 => 'random#9',
    3 => 'random#3',
    4 => 'random#9',
    5 => 'random#6',
    6 => 'random#1',
    7 => 'random#10',
    8 => 'random#8',
    9 => 'random#5',
  ),
  'affiliate_program' => 'random#3',
  'withdrawal_minimum' => 'random#7',
  'withdrawal_limits' => 
  array (
    0 => 'random#2',
    1 => 'random#2',
    2 => 'random#9',
    3 => 'random#2',
    4 => 'random#10',
    5 => 'random#6',
    6 => 'random#6',
    7 => 'random#4',
    8 => 'random#10',
    9 => 'random#5',
  ),
  'withdrawal_timeframes' => 
  array (
    0 => 'random#5',
    1 => 'random#1',
    2 => 'random#9',
    3 => 'random#7',
    4 => 'random#2',
    5 => 'random#4',
    6 => 'random#4',
    7 => 'random#1',
    8 => 'random#3',
    9 => 'random#10',
  ),
  'deposit_methods' => 
  array (
    0 => 'random#10',
    1 => 'random#1',
    2 => 'random#2',
    3 => 'random#8',
    4 => 'random#6',
    5 => 'random#3',
    6 => 'random#7',
    7 => 'random#4',
    8 => 'random#8',
    9 => 'random#10',
  ),
  'withdraw_methods' => 
  array (
    0 => 'random#1',
    1 => 'random#10',
    2 => 'random#2',
    3 => 'random#9',
    4 => 'random#1',
    5 => 'random#2',
    6 => 'random#4',
    7 => 'random#7',
    8 => 'random#5',
    9 => 'random#4',
  ),
));
$this->response->setAttribute("reviews", array (
  0 => 
  array (
    'id' => 1,
    'name' => 'random#10',
    'email' => 'random#5',
    'body' => 'random#10',
    'likes' => 6,
    'country' => 'random#7',
    'rating' => 3,
    'date' => '2018-01-17 15:37:12',
    'parent' => 9,
  ),
));
$this->response->setAttribute("total_reviews", 7);
	}
}
