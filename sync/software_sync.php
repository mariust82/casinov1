<?php
set_include_path(dirname(__DIR__)."/hlis/sync");

require_once("src/controllers/TableSynchronization.php");
require_once(__DIR__."/classes/CasinoproGameManufacturesSynchronization.php");

new CasinoslistsGameManufacturesSynchronization(dirname(__FILE__)."/configuration.xml");