<?php
require_once("CasinoCounter.php");
require_once("FieldValidator.php");

class BankingMethods implements CasinoCounter
{
    public function getCasinosCount()
    {
        return SQL("SELECT name, COUNT(DISTINCT casino_id) AS nr FROM
            ( SELECT t1.casino_id, t1.banking_method_id,t3.name FROM casinos__withdraw_methods AS t1 INNER JOIN banking_methods AS t3 ON (t1.banking_method_id = t3.id) INNER JOIN casinos AS t2 ON t2.id = t1.casino_id WHERE t2.is_open=1 
            UNION SELECT t1.casino_id, t1.banking_method_id,t3.name FROM casinos__deposit_methods AS t1 INNER JOIN banking_methods AS t3 ON (t1.banking_method_id = t3.id) INNER JOIN casinos AS t2 ON t2.id = t1.casino_id WHERE t2.is_open=1 ) AS alias 
            GROUP BY banking_method_id ORDER BY nr DESC
        ")->toMap("name", "nr");
    }
    
    public function getPopularBankingCasinosCount($banking)
    {
        $query = "SELECT name, COUNT(DISTINCT casino_id) AS nr FROM
            ( SELECT t1.casino_id, t1.banking_method_id,t3.name FROM casinos__withdraw_methods AS t1 INNER JOIN banking_methods AS t3 ON (t1.banking_method_id = t3.id) INNER JOIN casinos AS t2 ON t2.id = t1.casino_id WHERE t2.is_open=1 AND t3.name !='{$banking}'
            UNION SELECT t1.casino_id, t1.banking_method_id,t3.name FROM casinos__deposit_methods AS t1 INNER JOIN banking_methods AS t3 ON (t1.banking_method_id = t3.id) INNER JOIN casinos AS t2 ON t2.id = t1.casino_id WHERE t2.is_open=1  AND t3.name != '{$banking}') AS alias 
            GROUP BY banking_method_id ORDER BY priority DESC, nr DESC LIMIT 3
        ";
            echo $query;
        return SQL("SELECT name, COUNT(DISTINCT casino_id) AS nr FROM
            ( SELECT t1.casino_id, t1.banking_method_id,t3.name FROM casinos__withdraw_methods AS t1 INNER JOIN banking_methods AS t3 ON (t1.banking_method_id = t3.id) INNER JOIN casinos AS t2 ON t2.id = t1.casino_id WHERE t2.is_open=1 AND t3.name != {$banking}
            UNION SELECT t1.casino_id, t1.banking_method_id,t3.name FROM casinos__deposit_methods AS t1 INNER JOIN banking_methods AS t3 ON (t1.banking_method_id = t3.id) INNER JOIN casinos AS t2 ON t2.id = t1.casino_id WHERE t2.is_open=1  AND t3.name != {$banking}) AS alias 
            GROUP BY banking_method_id ORDER BY priority DESC, nr DESC LIMIT 3
        ")->toMap("name", "nr");
    }

    public function getAll()
    {
        return SQL("
        SELECT DISTINCT t1.name
        FROM banking_methods AS t1
        INNER JOIN casinos__deposit_methods AS t2 ON t1.id = t2.banking_method_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1
        ORDER BY t1.name ASC
        ")->toColumn();
    }
}
