<?php
set_include_path(dirname(__DIR__)."/hlis/sync");
require_once("src/controllers/CurrenciesSynchronization.php");
new CurrenciesSynchronization(dirname(dirname(__FILE__))."/stdout.xml");
