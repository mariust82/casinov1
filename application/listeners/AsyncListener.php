<?php
require_once("hlis/Async.php");

/**
 * Sets up information necessary for ASYNC calls to RestAPI @ DM.
 */
class AsyncListener extends Lucinda\MVC\STDOUT\RequestListener {
    public function run() {
        $authKEY = (string) $this->application->getTag("rest_api")["auth_key"];
        $host = (string) $this->application->getTag("rest_api")->{ENVIRONMENT};
        Async::setup($host, $authKEY);
    }
}