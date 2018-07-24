<?php
/**
 * Recipe for algorithm to generate unique cache keys
 */
interface CacheKeyGenerator
{
    /**
     * Gets key value
     *
     * @return string
     */
    function getValue();
}