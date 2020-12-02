<?php

namespace Hlis\Testing;

require("vendor/autoload.php");
require_once("hlis/unit_testing/SiteIntegrityChecker.php");

$environment = $argv && isset($argv[1]) ? $argv[1] : "dev";
$userAgent = $argv && isset($argv[2]) ? $argv[2] : SiteIntegrityChecker::USER_AGENT;
$domain = $argv && isset($argv[3]) ? $argv[3] : "build.casinoslists.com";
define("ENVIRONMENT", $environment);

new SiteIntegrityChecker($domain, new ConsoleUnitTestDisplay(), array(
    "index" => "index",
    "banking/(name)" => "banking/neteller",
    "banking" => "banking",
    "casinos/best" => "casinos/best",
    "casinos/popular" => "casinos/popular",
    "casinos/mobile" => "casinos/mobile",
    "casinos/new" => "casinos/new",
    "casinos/stay-away" => "casinos/stay-away",
    "casinos" => "casinos",
    "reviews/(name)-review" => "reviews/blighty-bingo-review",
    "warn/(name)" => "warn/vegas2web-casino",
    "bonus-list/(name)" => "bonus-list/no-deposit-bonus",
    "countries-list/(name)" => "countries-list/romania",
    "countries" => "countries",
    "softwares/(name)" => "softwares/rtg",
    "softwares" => "softwares",
    "games/(type)" => "games/video-slots",
    "games" => "games",
    "play/(name)" => "play/exotic-fruit-deluxe",
    "features/(name)" => "features/live-dealer",
    "privacy" => "privacy",
    "terms" => "terms",
    "contact" => "contact"
), $userAgent);
