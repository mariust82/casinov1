<?php
require_once("hlis/ip2country/detector.php");
require_once("application/models/dao/Countries.php");
require_once("application/models/dao/entities/Country.php");

/**
 * Delegates to IP2COUNTRY model to detect user country based on IP from MMDB db, wraps result into a Country entity
 * then assigns latter with country id detected from DB via Countries DAO.
 *
 * Saves response attributes:
 * - ip: detected client IP, validated for proxy headers, too
 * - country: detected Country entity
 */
class IPDetectionListener extends RequestListener
{
    public function run()
    {
        // sets MMDB file location
        $env = $this->application->getAttribute("environment");
        CountryDetection::$DB_FILE = (string)$this->application->getXML()->geoip->$env;

        // detects and saves country
        $country = CountryDetection::getInstance()->getCountry();
        $countries = new Countries();
        if ($country == null) {
            // if country could not be detected, defaults to US
            $country = new Country();
            $country->code = "US";
            $country->name = "United States";
        }
        $country->id = $countries->getIDByCode($country->code);
        $this->request->setAttribute('country', $country);

        // detects and saves ip
        $ip = IPDetection::getInstance()->getIP();
        $this->request->setAttribute('ip', ($ip != null) ? $ip : '127.0.0.1');
    }
}