<?php
ini_set('memory_limit', '1000M');
set_include_path(dirname(__DIR__) . "/hlis/sync");
require_once("src/controllers/NewGameSynchronization.php");
require_once("classes/CustomGamesSynchronization.php");
new CustomGamesSynchronization(__DIR__ . "/stdout.xml");
