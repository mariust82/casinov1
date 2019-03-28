<?php
set_include_path(dirname(__DIR__)."/hlis/sync");

require_once("src/controllers/RebrandingSynchronization.php");
new RebrandingSynchronization(dirname(dirname(__FILE__))."/configuration.xml", true);
