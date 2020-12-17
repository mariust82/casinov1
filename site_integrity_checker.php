<?php

namespace Hlis\Testing;

require("vendor/autoload.php");
require_once("site_integrity_checker/CasinosListsSiteIntegrityChecker.php");

$environment = $argv && isset($argv[1]) ? $argv[1] : "dev";
$userAgent = $argv && isset($argv[2]) ? $argv[2] : CasinosListsSiteIntegrityChecker::USER_AGENT;
$domain = $argv && isset($argv[3]) ? $argv[3] : "build.casinoslists.com";
define("ENVIRONMENT", $environment);

new CasinosListsSiteIntegrityChecker($domain, new ConsoleUnitTestDisplay(), array(
    "index" => "index",
    "banking" => "banking",
    "banking/(?)" => "banking/paypal",
    "bonus-list" => "bonus-list",
    "bonus-list/(?)" => "bonus-list/free-spins",
    "casinos" => "casinos",
    "casinos/(?)" => "casinos/best",
    "countries" => "countries",
    "countries-list/(?)" => "countries-list/united-states",
    "reviews/(?)-review" => "reviews/betadonis-casino-review",
    "features" => "features",
    "features/(?)" => "features/live-dealer",
    "games" => "games",
    "games/(?)" => "games/video-slots",
    "softwares" => "softwares",
    "softwares/(?)" => "softwares/rtg",
    "play/(?)" => "play/espresso",
    "live-dealer/(?)" => "live-dealer/roulette",
), $userAgent);
