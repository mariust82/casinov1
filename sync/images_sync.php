<?php
set_include_path(dirname(__DIR__)."/hlis/sync");

require_once("src/controllers/ImageSynchronization.php");
new ImageSynchronization(__DIR__."/stdout.xml");
