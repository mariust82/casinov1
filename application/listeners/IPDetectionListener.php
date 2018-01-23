<?php
require_once("hlis/ip2country/detector.php");
require_once("application/models/dao/Countries.php");

class IPDetectionListener extends RequestListener
{

    public function run()
    {
        $env = $this->application->getAttribute("environment");
        CountryDetection::$DB_FILE = (string)$this->application->getXML()->geoip->$env;

        $country = CountryDetection::getInstance()->getCountry();
        $countries = new Countries();
        if ($country == null) {
            // default to USA
            $country = $this->setDefaultCountry('US');
        } else {
            $country->id = $countries->getIDByCode($country->code);
        }
        $this->request->setAttribute('country', $country);
        $ip = IPDetection::getInstance()->getIP();
        $this->request->setAttribute('ip', ($ip != null) ? $ip : '127.0.0.1');
    }

    private function setDefaultCountry($code)
    {
        $country = new Country();
        switch ($code) {
            case 'US':
                $country->id = 34;
                $country->code = "US";
                $country->name = "United States";
                break;
            case 'GB':
                $country->id = 20;
                $country->code = "GB";
                $country->name = "United Kingdom";
                break;
            case 'IL':
                $country->id = 25;
                $country->code = "IL";
                $country->name = "Israel";
                break;
            case 'RO':
                $country->id = 43;
                $country->code = "RO";
                $country->name = "Romania";
                break;
            case 'RU':
                $country->id = 27;
                $country->code = "RU";
                $country->name = "Russian Federation";
                break;
            default :
                $country->id = 34;
                $country->code = "US";
                $country->name = "United States";
        }
        return $country;
    }
}