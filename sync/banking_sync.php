<?php
ini_set('memory_limit', '1000M');
set_include_path(dirname(__DIR__) . "/hlis/sync");
require_once("src/controllers/BankingMethodsSynchronization.php");
new BankingMethodsSynchronization(dirname(dirname(__FILE__)) . "/stdout.xml");
