<?php
require_once("CasinoCounter.php");
require_once("FieldValidator.php");

class BankingMethods implements CasinoCounter, FieldValidator
{
    public function getCasinosCount() {
        return DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM banking_methods AS t1
        INNER JOIN casinos__deposit_methods AS t2 ON t1.id = t2.banking_method_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1
        GROUP BY t1.id
        ORDER BY counter DESC 
        ")->toMap("unit","counter");
    }

    public function validate($name) {
        return DB("SELECT name FROM banking_methods WHERE name=:name",array(":name"=>$name))->toValue();
    }
}