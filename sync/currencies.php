<?php
set_include_path(dirname(__DIR__) . "/hlis/sync");
require_once("src/controllers/CurrenciesSynchronization.php");
require_once("classes/CustomCurrenciesSynchronization.php");
new CustomCurrenciesSynchronization(__DIR__ . "/stdout.xml");
