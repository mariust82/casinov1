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
function NoSQL($query, $boundParameters = [], $tags, $callback, $expirationTime = 3600)
{
    // generate nosql key
    $key = sha1(json_encode([$_SERVER["SERVER_NAME"], $query, $boundParameters]));

    // retrieve/persist to nosql
    $connection = Lucinda\NoSQL\ConnectionSingleton::getInstance();
    if ($connection->contains($key)) {
        $value = $connection->get($key);
        if ($value) {
            return unserialize($value);
        }
    }
    $value = $callback(SQL($query, $boundParameters));
    $connection->set($key, serialize($value), $expirationTime);

    // maintain key-tags association
    $cacheID = SQL("SELECT id FROM nosql__cache WHERE keyname=:keyname", [":keyname"=>$key])->toValue();
    $tagIDs = SQL("SELECT id FROM nosql__tags WHERE name IN ('".implode("','", $tags)."')")->toColumn();
    if (!$cacheID) {
        $cacheID = SQL("INSERT INTO nosql__cache (keyname) VALUES (:keyname)", [":keyname"=>$key])->getInsertId();
        foreach ($tagIDs as $tagID) {
            SQL("INSERT INTO nosql__cache_tags (cache_id, tag_id) VALUES (".$cacheID.", ".$tagID.")");
        }
    } else {
        $existingTagIDs = SQL("SELECT id, tag_id FROM nosql__cache_tags WHERE cache_id=:cache_id", [":cache_id"=>$cacheID])->toMap("id", "tag_id");
        $tagsToDelete = array_diff($existingTagIDs, $tagIDs);
        foreach ($tagsToDelete as $id=>$tagID) {
            SQL("DELETE FROM nosql__cache_tags WHERE id=:id", [":id"=>$id]);
        }
        $tagsToInsert = array_diff($tagIDs, $existingTagIDs);
        foreach ($tagsToInsert as $tagID) {
            SQL("INSERT INTO nosql__cache_tags (cache_id, tag_id) VALUES (".$cacheID.", ".$tagID.")");
        }
    }

    return $value;
}
