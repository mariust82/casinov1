<?php
ini_set('memory_limit', '1000M');
set_include_path(dirname(__DIR__) . "/hlis/sync");
require_once("src/controllers/NewCasinoSynchronization.php");
require_once("classes/LocalCasinoSynchronization.php");
new LocalCasinoSynchronization(__DIR__ . "/stdout.xml");
