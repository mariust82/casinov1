<?php
use Hlis\ServiceContainer;
use Hlis\QueryCache\Cache;
use Lucinda\SQL\ConnectionException;
use Lucinda\SQL\StatementResults;
use Lucinda\SQL\StatementException;
use Hlis\QueryCache\ResultSet;

require_once("dao/entities/Entity.php");

/**
 * Automates SQL query execution using DocumentDB cache
 *
 * @param string $query SQL query to execute
 * @param array $boundParameters List of bound keys and their values.
 * @return StatementResults|ResultSet Encapsulating query results.
 * @throws StatementException If SQL query fails.
 * @throws ConnectionException If SQL server connection fails
 */
function SQL($query, $boundParameters = array())
{
    // gets result from document DB if present
    $key = null;
    $cache = ServiceContainer::get(Cache::class);
    if ($queryAnalyzer = $cache->analyze($query)) {
        if ($key = $cache->getKey($queryAnalyzer, $boundParameters)) {
            if ($value = $cache->read($key)) {
                return $value;
            }
        }
    } else {
        $query = preg_replace("/(^|[\s|\n|\t]+)select([\s|\n|\t]+)/i", '${1}SELECT SQL_NO_CACHE${2}', $query, 1);
    }
    
    // compiles result from sql DB
    $benchmark = new Hlis\Benchmark("queries.log", 0.1);
    $preparedStatement = Lucinda\SQL\ConnectionSingleton::getInstance()->createPreparedStatement();
    $preparedStatement->prepare($query);
    $result = $preparedStatement->execute($boundParameters);
    $benchmark->run(["query" => $query, "parameters" => $boundParameters]);
    
    // if cacheable, update cache
    if ($key) {
        return $cache->write($key, $result->toList());
    } else {
        return $result;
    }
}
