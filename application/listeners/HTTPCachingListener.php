<?php
require_once("vendor/lucinda/http-caching/loader.php");
require_once("application/models/caching/CachingWrapper.php");

class HTTPCachingListener extends ResponseListener
{
    public function run() {
        if($this->request->getMethod()!="GET") return;
        new CachingWrapper($this->request, $this->response);
    }
}