<?php
function DB($strQuery, $boundParameters=array()) {
    $preparedStatement = SQLConnectionSingleton::getInstance()->createPreparedStatement();
    $preparedStatement->prepare($strQuery);
    foreach($boundParameters as $strParameter=>$mixValue) {
        $preparedStatement->bind($strParameter, $mixValue);
    }
    return $preparedStatement->execute();
}