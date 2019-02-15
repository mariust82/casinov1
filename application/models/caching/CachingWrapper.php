<?php
require_once("DefaultCacheable.php");

class CachingWrapper
{
    private $request;
    private $response;
    private $bypass = false;

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

    /**
     * Performs HTTP caching validation on request and returns resulting HTTP status code.
     *
     * @param DefaultCacheable $cacheable Driver able to generate an etag for an HTML pending display.
     * @return int HTTP status code
     */
    private function getStatusCode(DefaultCacheable $cacheable) {
        $cacheRequest = new CacheRequest();
        if(!$cacheRequest->getModifiedSince()) {
                return 200;
        } else if($cacheRequest->getModifiedSince() && $cacheRequest->getModifiedSince() > $cacheable->getTime()) {
                $this->bypass = true;
                return 200;
        } else if($cacheRequest->isValidatable()) {
                $validator = new CacheValidator($cacheRequest);
                return $validator->validate($cacheable);
        } else {
                return 200;
        }
    }

    /**
     * Generates response caching headers
     *
     * @param DefaultCacheable $cacheable Driver able to generate an etag for an HTML pending display.
     * @return array[string:string] $headers List of caching headers to add on top of content type
     */
    private function getHeaders(DefaultCacheable $cacheable) {
        $cacheResponse = new CacheResponse();
        if($cacheable->getTime() && !$this->bypass) {
            $cacheResponse->setLastModified($cacheable->getTime());
        }
	$cacheResponse->setPublic(); // hack against session usage
        return $cacheResponse->getHeaders();
    }

}
