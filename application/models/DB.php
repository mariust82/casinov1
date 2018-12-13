<?php

require_once "hlis/profilers/QueryProfiler.php";

/**
 * Automates SQL query execution.
 *
 * @param array $boundParameters List of bound keys and their values.
 * @return SQLStatementResults Encapsulating query results.
 * @throws SQLQueryException If SQL query fails.
 * @throws SQLException
 */
function DB($query, $boundParameters = array())
{
    $benchmark = false;

    if ($benchmark) {
        $preparedStatement = SQLConnectionSingleton::getInstance()->createPreparedStatement();
        $preparedStatement->prepare(str_replace("SELECT", "SELECT SQL_NO_CACHE", $query));

        foreach ($boundParameters as $strParameter => $mixValue) {
            $preparedStatement->bind($strParameter, $mixValue);
        }

        $profiler = new QueryProfiler($query);
        $profiler->start();
        $result = $preparedStatement->execute();
        $profiler->end();
        return $result;
    } else {
        $preparedStatement = SQLConnectionSingleton::getInstance()->createPreparedStatement();
        $preparedStatement->prepare($query);
        foreach ($boundParameters as $strParameter => $mixValue) {
            $preparedStatement->bind($strParameter, $mixValue);
        }
        return $preparedStatement->execute();
    }
}