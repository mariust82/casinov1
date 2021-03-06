<?php
use Lucinda\MVC\STDOUT\ApplicationListener;
use Hlis\ServiceContainer;
use Hlis\QueryCache\Cache;
use Hlis\QueryCache\Configuration;
use Hlis\QueryCache\FileDBDriver;

require_once("hlis/ServiceContainer.php");
require_once("hlis/query_cache/Cache.php");
require_once("hlis/query_cache/FileDBDriver.php");

class DatabaseCachingListener extends ApplicationListener
{
    public function run()
    {
        $connection = new \Lucinda\DB\Wrapper(dirname(__DIR__,2)."/xml/file_db.xml", ENVIRONMENT);
        ServiceContainer::set(Cache::class, new Cache(
            new Configuration($this->application->getTag("cache")),
            new FileDBDriver($connection)
            ));
        ServiceContainer::set(Wrapper::class, $connection);
    }
}

