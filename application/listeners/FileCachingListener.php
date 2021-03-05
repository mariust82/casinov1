<?php
require_once("application/models/CacheEntry.php");

class FileCachingListener extends Lucinda\MVC\STDOUT\ApplicationListener
{
    public function run()
    {
        CacheEntry::setDataSource(new Lucinda\DB\Wrapper(dirname(__DIR__,2)."/xml/file_db.xml", ENVIRONMENT));
    }
}
