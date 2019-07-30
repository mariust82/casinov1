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
class IPDetectionListener extends Lucinda\MVC\STDOUT\RequestListener
{
    public function run()
    {
        // sets MMDB file location
        $env = ENVIRONMENT;
        CountryDetection::$DB_FILE = (string)$this->application->getTag("geoip")->$env;

        // detects and saves country
        $countryDetected = CountryDetection::getInstance()->getCountry();
        $countries = new Countries();
        $country = new Country();
        if ($countryDetected == null) {
            $country->code = "US";
            $country->name = "United States";
        } else {
            $country->code = $countryDetected->code;
            $country->name = $countryDetected->name;
        }
        $country->id = $countries->getIDByCode($country->code);
        $this->request->attributes('country', $country);

        // detects and saves ip
        $ip = IPDetection::getInstance()->getIP();
        $this->request->attributes('ip', ($ip != null) ? $ip : '127.0.0.1');

    }
}