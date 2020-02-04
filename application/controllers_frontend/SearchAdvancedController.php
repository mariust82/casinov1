<?php
class SearchAdvancedController extends Lucinda\MVC\STDOUT\Controller {
    public function run() {
        $this->response->attributes("value", 'cas');
$this->response->attributes("index", 5);
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
  3 => 
  array (
    'name' => 'Bancontact Mister Cash',
    'count' => '42',
    'url' => 'banking/bancontact-mister-cash',
    'title' => 'Bancontact Mister Cash Accepted Online Casinos ',
  ),
  4 => 
  array (
    'name' => 'Todito Cash',
    'count' => '38',
    'url' => 'banking/todito-cash',
    'title' => 'Todito Cash Accepted Online Casinos ',
  ),
  5 => 
  array (
    'name' => 'Entercash',
    'count' => '22',
    'url' => 'banking/entercash',
    'title' => 'Entercash Accepted Online Casinos ',
  ),
  6 => 
  array (
    'name' => 'Intercash',
    'count' => '5',
    'url' => 'banking/intercash',
    'title' => 'Intercash Accepted Online Casinos ',
  ),
  7 => 
  array (
    'name' => 'CASHU',
    'count' => '5',
    'url' => 'banking/cashu',
    'title' => 'CASHU Accepted Online Casinos ',
  ),
  8 => 
  array (
    'name' => 'Insta Cash',
    'count' => '1',
    'url' => 'banking/insta-cash',
    'title' => 'Insta Cash Accepted Online Casinos ',
  ),
  9 => 
  array (
    'name' => 'William Hill CASHDIRECT',
    'count' => '1',
    'url' => 'banking/william-hill-cashdirect',
    'title' => 'William Hill CASHDIRECT Accepted Online Casinos ',
  ),
  10 => 
  array (
    'name' => 'GoCash',
    'count' => '1',
    'url' => 'banking/gocash',
    'title' => 'GoCash Accepted Online Casinos ',
  ),
));
$this->response->attributes("total_lists", 11);
$this->response->attributes("casinos", array (
  0 => 'Lippie Casino',
  1 => 'leu casino',
  2 => 'Norvegia Casino',
  3 => 'React Casino Abel',
  4 => 'ListCasino',
));
$this->response->attributes("total_casinos", 952);
$this->response->attributes("games", array (
  0 => 'Inspired Monster Cash',
  1 => 'Cash In The Antiques',
  2 => 'Willy Wongas Cash Factory',
  3 => 'Count Yer Cash',
  4 => 'Soft Magic Dice Kitty Cash',
));
$this->response->attributes("total_games", 183);

    }
}
        