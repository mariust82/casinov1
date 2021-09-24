<?php
require_once("entities/TestDataCasino.php");
require_once("entities/TestDataCasinoBonus.php");
require_once("queries/TestAjaxListQuery.php");

class TestPageDAO
{
    CONST LIMIT = 10;
    CONST OFFSET = 0;

    private array $queryFilters = array();

    public function __construct(string $showOpenedCasinos = 'false')
    {
        if($showOpenedCasinos=='true'){
            $this->queryFilters['where_condition'] = true;
        }
    }

    public function getCasinosInfo(): array
    {
        //$this->query = SQL("SELECT id, code, name FROM casinos ORDER BY name LIMIT :limit OFFSET :offset", array("limit"=>self::LIMIT, "offset"=>self::OFFSET));  //error: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''10' OFFSET '0'' at line 1
        //$resultSet = SQL("SELECT id, code, name FROM casinos ORDER BY name LIMIT ".self::LIMIT." OFFSET ".self::OFFSET);
        $queryGenerator = new TestFiltersListQuery($this->queryFilters);
        $resultSet = SQL($queryGenerator->getQuery());
        /*echo "<pre>";
        print_r($resultSet);
        die();*/
        $output = array();
        while ($row = $resultSet->toRow()) {
            $object = new TestDataCasino();
            $object->id = $row["id"];
            $object->code = $row["code"];
            $object->name = $row["name"];
            $object->casino_bonuses =  $this->getCasinoBonusesInfo($object->id);
            $output[$object->id] = $object;
        }
        return $output;
    }

    private function getCasinoBonusesInfo(int $casionId): array
    {
        $resultSet = SQL("
                SELECT 
                       t1.amount, 
                       t2.name AS bonus_type_name,
                       t1.bonus_type_id
                FROM casinos__bonuses AS t1 
                INNER JOIN bonus_types AS t2    
                    ON t1.bonus_type_id = t2.id
                WHERE t1.casino_id=:casino_id
                ORDER BY t1.bonus_type_id DESC
                ", array(":casino_id"=>$casionId)
        );
        $casino_bonuses_info = array();
        while ($row = $resultSet->toRow()) {
            $object = new TestDataCasinoBonus();
            $object->bonus_type_id = $row["bonus_type_id"];
            $object->amount = $row["amount"];
            $object->bonus_type_name = $row["bonus_type_name"];
            $casino_bonuses_info[] = $object;
        }
        return $casino_bonuses_info;
    }
}