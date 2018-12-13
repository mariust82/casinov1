<?php
require_once("DefaultCacheable.php");

class CachingWrapper
{
    private $request;
    private $response;

    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;

        $cacheable = new DefaultCacheable($this->request, $this->response);
        $this->display($this->getStatusCode($cacheable), $this->getHeaders($cacheable));
    }

    private function display($responseCode, $headers) {
        if($responseCode==200) {
            foreach($headers as $name=>$value) {
                $this->response->headers()->set($name, $value);
            }
        } else {
            $this->response->setStatus($responseCode);
            foreach($headers as $name=>$value) {
                $this->response->headers()->set($name, $value);
            }
            $this->response->getOutputStream()->clear();
        }
    }

    private function getStatusCode(Cacheable $cacheable) {
        $cacheRequest = new CacheRequest();
        if($cacheRequest->isValidatable()) {
            $validator = new CacheValidator($cacheRequest);
            return $validator->validate($cacheable);
        }
        return 200;
    }

    private function getHeaders(DefaultCacheable $cacheable) {
        $cacheResponse = new CacheResponse();
        if($cacheable->getTime()) {
            $cacheResponse->setLastModified($cacheable->getTime());
        }
        if($cacheable->getEtag()) {
            $cacheResponse->setEtag($cacheable->getEtag());
        }
        $cacheResponse->setPublic(); // hack against session usage
        return $cacheResponse->getHeaders();
    }
}