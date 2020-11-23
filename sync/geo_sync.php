<?php
set_include_path(dirname(__DIR__) . "/hlis/sync");
require_once("src/controllers/GeoIPSynchronization.php");
new GeoIPSynchronization(__DIR__ . "/stdout.xml");
