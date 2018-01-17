<?php
/*
* Game types list by number of games.
* 
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/37fe259e-efa9-47c2-a5e3-24b79e07b3c5/Games?fullscreen
*/
class GamesController extends Controller {
	public function run() {
		
$this->response->setAttribute("results", array (
  'random#9' => 2,
  'random#3' => 5,
  'random#6' => 6,
  'random#7' => 10,
  'random#4' => 5,
  'random#5' => 5,
  'random#8' => 7,
));
$this->response->setAttribute("icons", array (
  'random#6' => 'random#4',
  'random#9' => 'random#6',
  'random#4' => 'random#5',
  'random#1' => 'random#6',
  'random#5' => 'random#9',
  'random#7' => 'random#9',
  'random#8' => 'random#2',
  'random#10' => 'random#8',
));
	}
}
