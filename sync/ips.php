<?php
require_once(dirname(__DIR__)."/hlis/firewall/logs/LogsBinder.php");
new Hlis\Firewall\LogsBinder(1000, "casinoslists.com");
echo "OK";
