<?php
class SearchController extends Controller {
    public function run() {
        $this->response->setAttribute("casinos", array (
  0 => '007Slots Casino',
  1 => '123 Slots Online',
  2 => '1xSlots Casino',
));
$this->response->setAttribute("games", array (
  0 => 'Alice in Wonderslots',
  1 => 'Angel Slot',
  2 => 'Aztec Slots',
));

    }
}
        