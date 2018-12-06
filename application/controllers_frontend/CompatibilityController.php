<?php
class CompatibilityController extends Controller {
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
    'is_active' => true,
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
  'Mac' => '1088',
  'Linux' => '1026',
  'iOS' => '1010',
  'Android' => '1007',
  'Flash' => '1076',
  'Mobile' => '981',
));
$this->response->setAttribute("page_info", array (
  'head_title' => 'Online Casinos Filtered by Compatibilities types - 2018',
  'head_description' => 'Find an Online Casino that is Compatible with your Device and Operating System | Mobile Casinos, Mac Casinos, iPhone Casinos, Android Casinos and More!',
  'body_title' => 'Casinos Compatibility',
));

    }
}
        