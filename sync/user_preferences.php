<?php
set_include_path(dirname(__DIR__)."/hlis/sync");
require_once("src/controllers/UserPreferencesSynchronization.php");
new UserPreferencesSynchronization(dirname(__DIR__)."/stdout.xml");