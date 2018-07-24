<?php
require_once("CacheKeyGenerator.php");

/**
 * Implements a complex cache key whose value is the concatenation of hostname, key value and SQL SELECT criteria
 */
class CacheKeyAdvanced implements CacheKeyGenerator
{
    private $value;

    /**
     * Calls key to generate.
     *
     * @param string $keyName Cache key basic value.
     * @param array $where Condition that uniquely identifies this key against all with same basic value.
     * @param mixed $sortBy Sort criteria based on which resulting rows are ordered.
     * @param integer $offset Offset from which resulting rows start
     * @param integer $limit Limit at which resulting rows end
     */
    public function __construct($keyName, $where, $sortBy, $offset, $limit) {
        $this->setValue($keyName, $where, $sortBy, $offset, $limit);
    }

    /**
     * @param string $keyName Cache key basic value.
     * @param array $where Condition that uniquely identifies this key against all with same basic value.
     * @param mixed $sortBy Sort criteria based on which resulting rows are ordered.
     * @param integer $offset Offset from which resulting rows start
     * @param integer $limit Limit at which resulting rows end
     */
    public function setValue($keyName, $where, $sortBy, $offset, $limit) {
        $criteria = $where;
        $criteria["sort_by"] = $sortBy;
        $criteria["offset"] = $offset;
        $criteria["limit"] = $limit;
        $this->value = $_SERVER["SERVER_NAME"]."_".$keyName."_".md5(json_encode($criteria));
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