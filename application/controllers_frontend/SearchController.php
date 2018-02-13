<?php
class SearchController extends Controller {
    public function run() {
        $this->response->setAttribute("casinos", array (
  0 => '007Slots Casino',
  1 => '10Bet Casino',
  2 => '11.lv Casino',
));
$this->response->setAttribute("games", array (
  0 => '100 Pandas',
  1 => '1429 Uncharted Seas',
  2 => '1x2 Gaming Texas Holdem',
));

    }
}
        