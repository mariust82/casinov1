<?php
use Lucinda\MVC\STDOUT\ApplicationListener;
use Hlis\ServiceContainer;
use Hlis\QueryCache\Cache;
use Hlis\QueryCache\MongoDriver;
use Hlis\QueryCache\Configuration;

require_once("hlis/ServiceContainer.php");
require_once("hlis/query_cache/Cache.php");

class DatabaseCachingListener extends ApplicationListener
{
    public function run()
    {
        ServiceContainer::set(Cache::class, new Cache(
            new Configuration($this->application->getTag("cache")), 
            new MongoDriver("casinoslists.cache_".ENVIRONMENT)
        ));
    }
}

