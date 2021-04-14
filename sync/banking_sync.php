<?php
ini_set('memory_limit', '1000M');
set_include_path(dirname(__DIR__) . "/hlis/sync");
require_once("src/controllers/BankingMethodsSynchronization.php");
require_once("classes/CustomBankingMethodsSynchronization.php");
new CustomBankingMethodsSynchronization(__DIR__ . "/stdout.xml");
