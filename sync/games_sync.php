<?php
ini_set('memory_limit', '1000M');
set_include_path(dirname(__DIR__) . "/hlis/sync");
require_once("src/controllers/NewGameSynchronization.php");
new NewGameSynchronization(dirname(__FILE__) . "/configuration.xml", true);