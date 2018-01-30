<?php
class FeaturesController extends Controller {
    public function run() {
        $this->response->setAttribute("results", array (
  'Live Dealer' => '512',
  'eCOGRA Casinos' => '141',
  'High Roller Casinos' => 0,
  'Jackpot Casinos' => 0,
));

    }
}
        