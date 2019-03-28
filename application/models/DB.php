<?php
/**
 * Automates SQL query execution.
 *
 * @param string $query SQL query to execute
 * @param array $boundParameters List of bound keys and their values.
 * @return SQLStatementResults Encapsulating query results.
 * @throws SQLStatementException If SQL query fails.
 * @throws SQLConnectionException If SQL server connection fails
 */
function SQL($query, $boundParameters = array())
{
    $preparedStatement = SQLConnectionSingleton::getInstance()->createPreparedStatement();
    $preparedStatement->prepare($query);
    return $preparedStatement->execute($boundParameters);
}

/**
 * Leverages query execution to NoSQL cache.
 *
 * @param string $query SQL query to execute
 * @param array $boundParameters List of bound keys and their values to prepare query with.
 * @param callable $callback Logic to process resultSet retrieved after query execution
 * @param integer $expirationTime Time by which cache key expires (default: 1 hour)
 * @return mixed Result stored by cache originating from processed resultSet
 * @throws SQLStatementException If SQL query fails.
 * @throws SQLConnectionException If SQL server connection fails
 */
function NoSQL($query, $boundParameters, $callback, $expirationTime = 3600) {
    $key = $_SERVER["SERVER_NAME"]."__".md5($query.json_encode($boundParameters));
    $connection = NoSQLConnectionSingleton::getInstance();
    if($connection->contains($key)) {
        return unserialize($connection->get($key));
    } else {
        $value = $callback(SQL($query, $boundParameters));
        $connection->set($key, serialize($value), $expirationTime);
        return $value;
    }
}