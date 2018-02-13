<?php
class CasinoLabelsController extends Controller {
    public function run() {
        $this->response->setAttribute("menu_top", array (
  0 => 
  array (
    'title' => 'CASINOS',
    'url' => '/casinos',
    'is_active' => true,
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
    'is_active' => false,
  ),
  7 => 
  array (
    'title' => 'GAMES',
    'url' => '/games',
    'is_active' => false,
  ),
));
$this->response->setAttribute("results", array (
  'Stay away' => '118',
  'New' => '111',
  'Best' => '107',
  'Safe' => '85',
  'Recommended' => '35',
  'Popular' => '15',
));

    }
}
        