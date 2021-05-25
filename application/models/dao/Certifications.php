<?php
require_once("FieldValidator.php");

class Certifications implements FieldValidator
{
    public function getNumberOfCasinos($certification)
    {
        return SQL("
        SELECT
        count(t1.id) as counter
        FROM certifications AS t1
        INNER JOIN casinos__certifications AS t2 ON t1.id = t2.certification_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t1.name = :name AND t3.is_open = 1
        ", array(":name"=>$certification))->toValue();
    }

    public function validate($name)
    {
        return SQL("SELECT name FROM certifications WHERE name=:name", array(":name"=>$name))->toValue();
    }
}
