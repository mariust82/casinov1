<?php
set_include_path(dirname(__DIR__)."/hlis/sync");
require_once("src/controllers/UserPreferencesSynchronization.php");
new UserPreferencesSynchronization(__DIR__."/stdout.xml");