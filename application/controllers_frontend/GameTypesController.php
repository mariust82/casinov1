<?php
class GameTypesController extends Controller {
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
$this->response->setAttribute("results", array (
  'Video Slots' => '4525',
  'Video Poker' => '452',
  'Classic Slots' => '433',
  'Scratch Cards' => '285',
  'Blackjack' => '189',
  'Other' => '162',
  'Roulette' => '156',
  'Table Games' => '120',
  'Keno' => '46',
  'Bingo' => '35',
  'Baccarat' => '33',
  'Craps' => '12',
));
$this->response->setAttribute("icons", array (
  'Baccarat' => 'NetEnt Baccarat Pro Series',
  'Bingo' => 'NetEnt Bingo',
  'Blackjack' => 'NetEnt Blackjack Pro',
  'Classic Slots' => 'Break the Bank',
  'Craps' => 'BetSoft Craps',
  'Keno' => 'NetEnt Bonus Keno',
  'Other' => 'Golden Derby',
  'Roulette' => 'NetEnt French Roulette Pro',
  'Scratch Cards' => 'Beach Bums',
  'Table Games' => 'NetEnt Caribbean Stud',
  'Video Poker' => 'Playtech 4 Line Jacks or Better',
  'Video Slots' => 'Aladdins Loot',
));

    }
}
        