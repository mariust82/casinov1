<?php
set_include_path(dirname(__DIR__)."/hlis/sync");
require_once("src/controllers/AffiliateProgramsSynchronization.php");
new AffiliateProgramsSynchronization(dirname(__FILE__)."/configuration.xml",true);