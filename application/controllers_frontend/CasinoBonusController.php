<?php
class CasinoBonusController extends Lucinda\MVC\STDOUT\Controller {
    public function run() {
        $this->response->attributes("bonus", array (
  'amount' => '200%+100 FS',
  'min_deposit' => '$20',
  'wagering' => '25x(D+B)',
  'games_allowed' => 'All games',
  'code' => 'SLOTO1MATCH',
  'type' => 'First Deposit Bonus',
  'bonus_type_Abbreviation' => NULL,
));

    }
}
        