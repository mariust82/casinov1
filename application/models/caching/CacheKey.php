<?php
require_once("CacheKeyGenerator.php");

/**
 * Implements a cache key whose value is the concatenation of hostname and key value.
 */
class CacheKey implements CacheKeyGenerator
{
    private $value;

    /**
     * Calls key to generate.
     *
     * @param string $keyName Cache key basic value.
     */
    public function __construct($keyName) {
        $this->setValue($keyName);
    }

    /**
     * Generates value by concatenating hostname with key value
     *
     * @param string $keyName
     */
    public function setValue($keyName) {
        $this->value = $_SERVER["SERVER_NAME"]."_".$keyName;
    }

    /**
     * Gets value of key
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}