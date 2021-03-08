<?php
require_once("dao/entities/Entity.php");
        
/**
 * Automates SQL query execution.
 *
 * @param string $query SQL query to execute
 * @param array $boundParameters List of bound keys and their values.
 * @return \Lucinda\SQL\StatementResults Encapsulating query results.
 * @throws \Lucinda\SQL\StatementException If SQL query fails.
 * @throws \Lucinda\SQL\ConnectionException If SQL server connection fails
 */
function SQL($query, $boundParameters = array())
{
    $start = microtime(true);
    $preparedStatement = Lucinda\SQL\ConnectionSingleton::getInstance()->createPreparedStatement();
    $preparedStatement->prepare($query);
    $result = $preparedStatement->execute($boundParameters);
    $end = microtime(true);
    if (($end-$start)>=0.1) {
        error_log(json_encode(["duration"=>($end-$start), "url"=>$_SERVER["REQUEST_URI"], "query"=>$query, "parameters"=>$boundParameters])."\n", 3, "queries.log");
    }
    return $result;
}

/**
 * Leverages query execution to NoSQL cache.
 *
 * @param string $query SQL query to execute
 * @param array $boundParameters List of bound keys and their values to prepare query with.
 * @param array $tags List of bound keys and their values to prepare query with.
 * @param callable $callback Logic to process resultSet retrieved after query execution
 * @param integer $expirationTime Time by which cache key expires (default: 1 hour)
 * @return mixed Result stored by cache originating from processed resultSet
 * @throws \Lucinda\SQL\StatementException If SQL query fails.
 * @throws \Lucinda\SQL\ConnectionException If SQL server connection fails
 */
function NoSQL(string $query, array $boundParameters, array $tags, callable $callback)
{
    $tags[] = sha1(json_encode([$query, $boundParameters]));
    $entry = CacheEntry::getInstance($tags);
    if ($entry->exists()) {
        return $entry->get();
    }
    $value = $callback(SQL($query, $boundParameters));
    $entry->set($value);
    return $value;
}
