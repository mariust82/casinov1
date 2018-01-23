<?php
require_once("hlis/sitebase/Async.php");

/**
 * Sets up information necessary for ASYNC calls to RestAPI @ DM.
 */
class AsyncListener extends ApplicationListener
{
    public function run()
    {
        $authKEY = (string)$this->application->getXML()->rest_api["auth_key"];
        $host = (string)$this->application->getXML()->rest_api->{$this->application->getAttribute("environment")};
        Async::setup($host, $authKEY);
    }
}