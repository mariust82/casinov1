<?php
class CasinoBonusController extends Controller {
    public function run() {
        $this->response->setAttribute("bonus", array (
  'amount' => '100% + 240 FS',
  'min_deposit' => '$25',
  'wagering' => '15x(D+B)',
  'games_allowed' => 'Slots, Keno, Bingo, Specialty games (FS - Variety of Slots)',
  'code' => 'No code required',
  'type' => 'First Deposit Bonus',
));
$this->response->setAttribute("is_mobile", false);

    }
}
        