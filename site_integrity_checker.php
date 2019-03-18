<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 18-Mar-19
 * Time: 4:22 PM
 */
use Hlis\Testing\SiteIntegrityChecker;
require_once("hlis/unit_testing/src/SiteIntegrityChecker.php");

class CasinosListsIntegrityChecker extends SiteIntegrityChecker {
    private $pages = array(
        "index"  => "index",
        "banking/(name)" => "banking/neteller",
        "banking" => "banking",
        "casinos/(name)" => "casinos/best",
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
    );

    public function __construct($domainName)
    {
        if(strpos($domainName, "http")) die("Invalid domain name!");
        foreach($this->pages as $name=>$url) {
            $object = new Hlis\Testing\HttpCachingValidator("https://".$domainName."/".$url);
            $this->showLine("Hlis\Testing\HttpCachingValidator", $name, $object->getResult());
        }
        $object = new Hlis\Testing\RobotsValidator("https://".$domainName);
        $this->showLine("Hlis\Testing\RobotsValidator", "robots.txt", $object->getResult());

        foreach($this->pages as $name=>$url) {
            $object = new Hlis\Testing\PageSpeedChecker("https://".$domainName."/".$url);
            $this->showLine("Hlis\Testing\PageSpeedChecker", $name, $object->getResult());
        }

        foreach($this->pages as $name=>$url) {
            $object = new Hlis\Testing\HttpLinksValidator("https://".$domainName."/".$url);
            $this->showLine("Hlis\Testing\HttpLinksValidator", $name, $object->getResult());
        }
    }
}

new CasinosListsIntegrityChecker(strpos(__DIR__, "dev/site")?"dev.casinoslists.com":"www.casinoslists.com");