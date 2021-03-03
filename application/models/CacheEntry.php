<?php
class CacheEntry
{
    private static $instance;
    
    public static function setDataSource(Lucinda\DB\Wrapper $wrapper) {
        self::$instance = $wrapper;
    }
    
    public static function getInstance(array $tags)
    {
        return self::$instance->getEntryDriver($tags);
    }
}