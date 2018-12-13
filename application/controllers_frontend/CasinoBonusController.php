<?php
class CasinoBonusController extends Controller {
    public function run() {
        $this->response->setAttribute("bonus", array (
  'amount' => '$/€/£10',
  'min_deposit' => '',
  'wagering' => '20xB',
  'games_allowed' => 'Slots',
  'code' => 'No code required',
  'type' => 'No Deposit Bonus',
));

    }
}
        