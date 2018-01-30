<?php
class GameTypesController extends Controller {
    public function run() {
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
        