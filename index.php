<?php
require_once("hlis/firewall/Manager.php");
var_dump('test');
// performs environment detection
$environment = getenv("ENVIRONMENT");
if(!$environment) die("Value of environment variable 'ENVIRONMENT' could not be detected!");
define("ENVIRONMENT", $environment);
var_dump('test1');
// takes control of STDERR
require_once("vendor/lucinda/errors-mvc/src/FrontController.php");
require_once("application/models/EmergencyHandler.php");
new Lucinda\MVC\STDERR\FrontController((ENVIRONMENT!="frontend"?"stderr.xml":"stderr_frontend.xml"), ENVIRONMENT, __DIR__, new EmergencyHandler());
var_dump('test2');
// takes control of STDOUT
require_once("vendor/lucinda/mvc/loader.php");
new Lucinda\MVC\STDOUT\FrontController((ENVIRONMENT!="frontend"?"stdout.xml":"stdout_frontend.xml"));
var_dump('test3');
