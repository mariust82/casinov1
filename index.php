<?php
// performs environment detection
$environment = getenv("ENVIRONMENT");
if(!$environment) die("Value of environment variable 'ENVIRONMENT' could not be detected!");
define("ENVIRONMENT", $environment);

// load firewall
if (ENVIRONMENT == "live") {
    require_once("hlis/firewall/Manager.php");
    $firewall = new Hlis\Firewall\Manager($_SERVER["SERVER_NAME"], $_SERVER["REMOTE_ADDR"], $_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"], getallheaders());
    define("USER_TYPE", $firewall->getUserType());
}

// takes control of STDERR
require_once("vendor/lucinda/errors-mvc/src/FrontController.php");
require_once("application/models/EmergencyHandler.php");
new Lucinda\MVC\STDERR\FrontController((ENVIRONMENT!="frontend"?"stderr.xml":"stderr_frontend.xml"), ENVIRONMENT, __DIR__, new EmergencyHandler());

// takes control of STDOUT
require_once("vendor/lucinda/mvc/loader.php");
new Lucinda\MVC\STDOUT\FrontController((ENVIRONMENT!="frontend"?"stdout.xml":"stdout_frontend.xml"));
