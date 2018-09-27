<?php

require_once("hlis/sitebase/profilers/SiteProfiler.php");
$bm = new SiteProfiler($benchmark = false);

// take control of STDERR
require_once("src/error_handling/ErrorsFrontController.php");
new ErrorsFrontController();

// take control of STDOUT
require_once("vendor/lucinda/mvc/loader.php");
try {
    new FrontController("configuration.xml");
} catch (PathNotFoundException $e) {
    $_SERVER["REQUEST_URI"] = "/404";
    new FrontController("configuration.xml");
}
