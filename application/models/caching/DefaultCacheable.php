<?php
class DefaultCacheable implements Cacheable
{
    private $etag;

    public function __construct(Request $request, Response $response) {
        if(strpos($request->getValidator()->getPage(), "search")===0) return;
        $this->etag = sha1(json_encode($response->headers()->toArray())."#".$response->getOutputStream()->get());
    }

    public function getEtag() {
        return null;
    }

    public function getTime() {
        $modifiedTime = "";
        if($this->etag) {
            $connection = NoSQLConnectionSingleton::getInstance();
            if($connection->contains($this->etag)) {
                $modifiedTime = $connection->get($this->etag);
		if(!$modifiedTime) $connection->delete($this->etag);
            } else {
                $connection->set($this->etag, time(), 24*60*60);
            }
        }
        return $modifiedTime;
    }
}