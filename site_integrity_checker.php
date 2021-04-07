<?php
ini_set("display_errors", 1);
require("vendor/autoload.php");
require_once("hlis/unit_testing/ConsoleWrapper.php");

\Hlis\Testing\PageSpeedValidator::$tolerance = 400;
$wrapper = new \Hlis\Testing\ConsoleWrapper($argv, "casinoslists");
$wrapper->run([
    "index" => "index",
    "banking" => "banking",
    "banking/(?)" => "banking/paypal",
    "bonus-list" => "bonus-list",
    "bonus-list/(?)" => "bonus-list/free-spins",
    "casinos" => "casinos",
    "casinos/(?)" => "casinos/best",
    "casinos/(low-minimum-deposit)" => "casinos/low-minimum-deposit",
    "casinos/(fast-payout)" => "casinos/fast-payout",
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
], [
    "/visit/*"
]);
