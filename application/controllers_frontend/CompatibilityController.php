<?php
class CompatibilityController extends Controller {
    public function run() {
        $this->response->setAttribute("results", array (
  'Mac' => '1088',
  'Linux' => '1026',
  'iOS' => '1010',
  'Android' => '1007',
  'Flash' => '1076',
  'Mobile' => '981',
));

    }
}
        