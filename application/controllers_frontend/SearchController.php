<?php
class SearchController extends Lucinda\MVC\STDOUT\Controller {
    public function run() {
        $this->response->attributes("lists", array (
  0 => 
  array (
    'name' => 'Casino Technology',
    'count' => '8',
    'url' => 'softwares/casino-technology',
    'title' => 'Casino Technology Casinos List',
  ),
  1 => 
  array (
    'name' => 'CasinoSkillGaming',
    'count' => '2',
    'url' => 'softwares/casinoskillgaming',
    'title' => 'CasinoSkillGaming Casinos List',
  ),
  2 => 
  array (
    'name' => 'Cassava Enterprise',
    'count' => '2',
    'url' => 'softwares/cassava-enterprise',
    'title' => 'Cassava Enterprise Casinos List',
  ),
));
$this->response->attributes("casinos", array (
  0 => 'Lippie Casino',
  1 => 'leu casino',
  2 => 'Norvegia Casino',
));
$this->response->attributes("games", array (
  0 => 'Inspired Monster Cash',
  1 => 'Cash In The Antiques',
  2 => 'Willy Wongas Cash Factory',
));

    }
}
        