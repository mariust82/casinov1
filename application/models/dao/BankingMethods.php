<?php
require_once("CasinoCounter.php");
require_once("FieldValidator.php");
require_once("entities/BankingMethod.php");

class BankingMethods implements CasinoCounter
{
    public function getPopular($countryID, $limit)
    {
        // gets all banking methods accepted by country sorted by priority
        $bankingMethods = [];
        $resultSet = SQL("
        (
        SELECT t1.id, t1.name, t1.priority
        FROM banking_methods AS t1
        LEFT JOIN banking_methods__countries AS t2 ON t1.id = t2.banking_method_id
        WHERE t1.is_open = 1 AND t2.id IS NULL 
        )        
        UNION        
        (
        SELECT t1.id, t1.name, t1.priority
        FROM banking_methods AS t1
        INNER JOIN banking_methods__countries AS t2 ON t1.id = t2.banking_method_id AND t2.country_id = :country AND is_allowed = 1
        WHERE t1.is_open = 1
        )        
        UNION        
        (
        SELECT t1.id, t1.name, t1.priority
        FROM banking_methods AS t1
        INNER JOIN banking_methods__countries AS t2 ON t1.id = t2.banking_method_id AND t2.is_allowed = 0
        LEFT JOIN banking_methods__countries AS t3 ON t2.id = t3.id AND t3.country_id = :country AND t3.is_allowed = 0
        WHERE t1.is_open = 1 AND t3.id IS NULL
        )
        ORDER BY priority DESC, id DESC
        LIMIT ".$limit, [":country"=>$countryID]);
        while($row = $resultSet->toRow()) {
            $bankingMethods[$row["id"]] = [
                "name"=>$row["name"],
                "casinos"=>0
            ]; 
        }
        
        // get number of casinos for above
        $resultSet = SQL("
        SELECT casino_id, banking_method_id
        FROM casinos__deposit_methods
        INNER JOIN  casinos as c ON casino_id = c.id AND c.is_open=1
        WHERE banking_method_id IN (".implode(",", array_keys($bankingMethods)).")
        
        UNION
        
        SELECT casino_id, banking_method_id
        FROM casinos__withdraw_methods
        INNER JOIN  casinos as c ON casino_id = c.id AND c.is_open=1
        WHERE banking_method_id IN (".implode(",", array_keys($bankingMethods)).")
        ");
        while($row = $resultSet->toRow()) {
            $bankingMethods[$row["banking_method_id"]]["casinos"]++;
        }
        return $bankingMethods;
    }
    
    public function getCasinosCount()
    {
        return SQL("SELECT name, COUNT(DISTINCT casino_id) AS nr FROM
            ( SELECT t1.casino_id, t1.banking_method_id,t3.name FROM casinos__withdraw_methods AS t1 INNER JOIN banking_methods AS t3 ON (t1.banking_method_id = t3.id) INNER JOIN casinos AS t2 ON t2.id = t1.casino_id WHERE t2.is_open=1 
            UNION SELECT t1.casino_id, t1.banking_method_id,t3.name FROM casinos__deposit_methods AS t1 INNER JOIN banking_methods AS t3 ON (t1.banking_method_id = t3.id) INNER JOIN casinos AS t2 ON t2.id = t1.casino_id WHERE t2.is_open=1 ) AS alias 
            GROUP BY banking_method_id 
            ORDER BY nr DESC, banking_method_id ASC
        ")->toMap("name", "nr");
    }
    
    public function getPopularBankingCasinosCount($banking)
    {
        return SQL("SELECT name, COUNT(DISTINCT casino_id) AS nr FROM
            ( SELECT t1.casino_id, t1.banking_method_id,t3.name,t3.priority FROM casinos__withdraw_methods AS t1 INNER JOIN banking_methods AS t3 ON (t1.banking_method_id = t3.id) INNER JOIN casinos AS t2 ON t2.id = t1.casino_id WHERE t2.is_open=1 AND t3.name != '{$banking}'
            UNION SELECT t1.casino_id, t1.banking_method_id,t3.name,t3.priority FROM casinos__deposit_methods AS t1 INNER JOIN banking_methods AS t3 ON (t1.banking_method_id = t3.id) INNER JOIN casinos AS t2 ON t2.id = t1.casino_id WHERE t2.is_open=1  AND t3.name != '{$banking}') AS alias 
            GROUP BY banking_method_id ORDER BY priority DESC, nr DESC LIMIT 3
        ")->toMap("name", "nr");
    }
    
    public function getInfo($name) {
        $row = SQL("SELECT id, name FROM banking_methods WHERE name=:name", array(":name"=>$name))->toRow();
        $object = new BankingMethod();
        $object->id = $row["id"];
        $object->name = $row["name"];
        return $object;
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
    
    public function getAllByDate()
    {
        return SQL("
        SELECT t1.name, MAX(t3.date) AS sort_criteria
        FROM banking_methods AS t1
        INNER JOIN casinos__deposit_methods AS t2 ON t1.id = t2.banking_method_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1
        GROUP BY t1.name
        ORDER BY sort_criteria DESC, t1.id DESC")->toMap("name", "sort_criteria");
    }

    public function getIdByName($name)
    {
        $value = SQL('SELECT id FROM banking_methods WHERE name = :name', [':name' => $name])->toValue();

        return $value ? $value : 0;
    }
}
