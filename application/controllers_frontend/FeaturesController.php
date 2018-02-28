<?php
class FeaturesController extends Controller {
    public function run() {
        $this->response->setAttribute("menu_top", array (
  0 => 
  array (
    'title' => 'CASINOS',
    'url' => '/casinos',
    'is_active' => false,
  ),
  1 => 
  array (
    'title' => 'SOFTWARES',
    'url' => '/softwares',
    'is_active' => false,
  ),
  2 => 
  array (
    'title' => 'BONUSES',
    'url' => '/bonus-list',
    'is_active' => false,
  ),
  3 => 
  array (
    'title' => 'COUNTRIES',
    'url' => '/countries',
    'is_active' => false,
  ),
  4 => 
  array (
    'title' => 'COMPATIBILITY',
    'url' => '/compatability',
    'is_active' => false,
  ),
  5 => 
  array (
    'title' => 'BANKING',
    'url' => '/banking',
    'is_active' => false,
  ),
  6 => 
  array (
    'title' => 'FEATURES',
    'url' => '/features',
    'is_active' => true,
  ),
  7 => 
  array (
    'title' => 'GAMES',
    'url' => '/games',
    'is_active' => false,
  ),
));
$this->response->setAttribute("results", array (
  'Live Dealer' => '512',
  'eCOGRA Casinos' => '141',
  'High Roller Casinos' => 0,
  'Jackpot Casinos' => 0,
));
$this->response->setAttribute("page_info", array (
  'head_title' => 'Special Feature Casinos - Live Dealer, eCOGRA, High Roller Casinos',
  'head_description' => 'Online Casinos with Special Features | Live Dealer Casinos List, eCOGRA Casinos List, High Roller Casinos List and More on CasinosLists.com - 2018',
  'body_title' => 'Online Casino Features',
));

    }
}
        