<?php
class SearchAdvancedController extends Controller {
    public function run() {
        $this->response->setAttribute("value", 'slot');
$this->response->setAttribute("casinos", array (
  0 => '007Slots Casino',
  1 => '123 Slots Online',
  2 => '1xSlots Casino',
  3 => '99 Slot Machines',
  4 => 'All Slots Casino',
));
$this->response->setAttribute("total_casinos", 96);
$this->response->setAttribute("games", array (
  0 => 'Alice in Wonderslots',
  1 => 'Angel Slot',
  2 => 'Aztec Slots',
  3 => 'Beauty Slot',
  4 => 'Bingo Slot',
));
$this->response->setAttribute("total_games", 93);

    }
}
        