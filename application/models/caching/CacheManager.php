<?php
require_once("CacheKeyGenerator.php");

/**
 * Manager of reading and writing data to a NoSQL database
 */
class CacheManager
{
    private $key;

    /**
     * Generates key to read from or write to through delegation to an external algorithm.
     *
     * @param CacheKeyGenerator $cacheKeyGenerator Algorithm of cache key generation.
     */
    public function __construct(CacheKeyGenerator $cacheKeyGenerator) {
        $this->key = $cacheKeyGenerator->getValue();
    }

    /**
     * Reads value from NoSQL database based on key
     *
     * @return mixed|null Any PHP data type or NULL if no value exists for key.
     */
    public function get() {
        try {
            return NoSQLConnectionSingleton::getInstance()->get($this->key);
        } catch(KeyNotFoundException $e) {
            return null;
        }
    }

    /**
     * Writes value to NoSQL database based on key, expiring in 60 seconds by default
     *
     * @param mixed $value Value to save on key.
     * @param int $expirationTime Time in seconds until key-value is purged from DB to save RAM.
     */
    public function set($value, $expirationTime = 60) {
        NoSQLConnectionSingleton::getInstance()->set($this->key, $value, $expirationTime);
    }
}