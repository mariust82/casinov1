<?php
namespace Hlis\Testing;

require_once("hlis/unit_testing/src/SiteIntegrityChecker.php");

new SiteIntegrityChecker((strpos(__DIR__, "dev/site")?"dev.casinoslists.com":"www.casinoslists.com"), new ConsoleUnitTestDisplay(), array(
        "index"  => "index",
        "banking/(name)" => "banking/neteller",
        "banking" => "banking",
        "casinos/best" => "casinos/best",
        "casinos/popular" => "casinos/popular",
        "casinos/mobile" => "casinos/mobile",
        "casinos/new" => "casinos/new",
        "casinos/stay-away" => "casinos/stay-away",
        "casinos" => "casinos",
        "reviews/(name)-review" => "reviews/blighty-bingo-review",
        "warn/(name)" => "warn/Vegas2Web-Casino",
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
));
