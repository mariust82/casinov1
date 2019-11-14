<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
require_once(dirname(__DIR__)."/hlis/firewall/logs/LogsBinder.php");
new Hlis\Firewall\LogsBinder("casinoslists", 1000, "casinoslists.com");
echo "OK";
