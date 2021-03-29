<?php

namespace Hlis\Testing;

require_once("hlis/unit_testing/SiteIntegrityChecker.php");
require_once("CasinosListsRobotsValidator.php");

/**
 * Class SlotsMateSiteIntegrityChecker
 *
 * @package Hlis\Testing
 */
class CasinosListsSiteIntegrityChecker extends SiteIntegrityChecker
{
    /**
     * Kick starts unit tests.
     *
     * @param string $domainName Domain name of site (eg: dev.spinmybonus.com)
     * @param UnitTestDisplay $display Medium to display unit test results (eg: new ConsoleUnitTestDisplay())
     * @param string[string] Array of non-ajax related routes in site where key is route pattern and value is route example
     * @param string $userAgent
     */
    public function __construct(string $domainName, UnitTestDisplay $display, array $pages, string $userAgent = self::USER_AGENT)
    {
        if (strpos($domainName, "http")) die("Invalid domain name!");
        $this->domainName = $domainName;
        $this->display = $display;
        $this->userAgent = $userAgent;
        
        $this->checkSimple(new HtaccessValidator(".htaccess"), ".htaccess");
        $this->checkSimple(new CasinosListsRobotsValidator("https://" . $this->domainName . "/robots.txt?t=".uniqid()), "robots.txt");
        
        $responses = $this->setResponses($pages);
        $this->checkMulti(new HttpLinksValidator($responses), $pages);
        $this->checkMulti(new SeoValidator($responses), $pages);
        $this->checkMulti(new HttpStatusValidator($responses), $pages);
        $this->checkMulti(new PageSpeedValidator($responses), $pages);
    }

}