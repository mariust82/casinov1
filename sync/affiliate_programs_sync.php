<?php
set_include_path(dirname(__DIR__)."/hlis/sync");
require_once("src/controllers/AffiliateProgramsSynchronization.php");
new AffiliateProgramsSynchronization(__DIR__."/stdout.xml");
