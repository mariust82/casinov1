<?php
class SearchAdvancedController extends Controller {
    public function run() {
        $this->response->setAttribute("value", 'as');
$this->response->setAttribute("casinos", array (
  0 => '007Slots Casino',
  1 => '10Bet Casino',
  2 => '11.lv Casino',
  3 => '138.com Casino',
  4 => '188Bet Casino',
));
$this->response->setAttribute("total_casinos", 1161);
$this->response->setAttribute("games", array (
  0 => '100 Pandas',
  1 => '1429 Uncharted Seas',
  2 => '1x2 Gaming Texas Holdem',
  3 => '1X2 Gaming Treasure Tomb',
  4 => '1X2Gaming Casino Wars',
));
$this->response->setAttribute("total_games", 641);

    }
}
        