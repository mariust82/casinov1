<?php
set_include_path(dirname(__DIR__)."/hlis/sync");
require_once(__DIR__."/classes/CasinoslistsGameManufacturesSynchronization.php");

new CasinoslistsGameManufacturesSynchronization(dirname(__FILE__)."/configuration.xml");