<?php
/**
 * Automates SQL query execution.
 *
 * @param string $strQuery SQL query to execute.
 * @param array $boundParameters List of bound keys and their values.
 * @return SQLStatementResults Encapsulating query results.
 * @throws SQLQueryException If SQL query fails.
 * @throws SQLConnectionException If SQL connection fails.
 */
function DB($strQuery, $boundParameters=array()) {
    $preparedStatement = SQLConnectionSingleton::getInstance()->createPreparedStatement();
    $preparedStatement->prepare($strQuery);
    foreach($boundParameters as $strParameter=>$mixValue) {
        $preparedStatement->bind($strParameter, $mixValue);
    }
    return $preparedStatement->execute();
}