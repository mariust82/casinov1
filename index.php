<?php
require "vendor/autoload.php";
// load benchmark
require "hlis/Benchmark.php";
$benchmark = new \Hlis\Benchmark("pages.log", 0.25);

// performs environment detection
$environment = getenv("ENVIRONMENT");
if (!$environment) die("Value of environment variable 'ENVIRONMENT' could not be detected!");
define("ENVIRONMENT", $environment);

// load firewall
if (ENVIRONMENT == "live" && strpos(__DIR__, "/live/site")) {
    require_once("hlis/firewall_client/Manager.php");
    $firewall = new Hlis\Firewall\Manager($_SERVER["SERVER_NAME"], $_SERVER["REMOTE_ADDR"], $_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"], getallheaders());
    if ($userType = $firewall->getUserType()) {
        define("USER_TYPE", $userType);
    } else {
        header("HTTP/1.1 400 Bad Request");
        require_once "application/views/400.html";
        exit();
    }
}

// takes control of STDERR
require_once("vendor/lucinda/errors-mvc/src/FrontController.php");
require_once("application/models/EmergencyHandler.php");
new Lucinda\MVC\STDERR\FrontController((ENVIRONMENT != "frontend" ? "stderr.xml" : "stderr_frontend.xml"), ENVIRONMENT, __DIR__, new EmergencyHandler());

// takes control of STDOUT
require_once("vendor/lucinda/mvc/loader.php");
new Lucinda\MVC\STDOUT\FrontController((ENVIRONMENT != "frontend" ? "stdout.xml" : "stdout_frontend.xml"));

// run benchmark
$benchmark->run();
