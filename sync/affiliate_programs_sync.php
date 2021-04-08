<?php
set_include_path(dirname(__DIR__)."/hlis/sync");
require_once("src/controllers/AffiliateProgramsSynchronization.php");
require_once("classes/CustomAffiliateProgramsSynchronization.php");
new CustomAffiliateProgramsSynchronization(__DIR__ . "/stdout.xml");
