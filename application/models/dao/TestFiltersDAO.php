<?php
require_once("entities/TestDataCasino.php");
require_once("entities/TestDataCasinoBonus.php");
require_once("queries/TestFiltersListQuery.php");

class TestFiltersDAO
{

    public function getCasinosInfo($aParameters)
    {
        $queryGenerator = new TestFiltersListQuery($aParameters);
        $resultSet = SQL($queryGenerator->getQuery());
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

    private function getCasinoBonusesInfo(int $casionId)
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

    public function getCasinosInfoOld($aParameters)
    {
        $queryGenerator = new TestFiltersListQuery($aParameters);
        $resultSet = SQL($queryGenerator->getQuery());

        $output = array();
        while ($row = $resultSet->toRow()) {
            $object = new TestDataCasino();
            $object->id = $row["id"];
            $object->code = $row["code"];
            $object->name = $row["name"];
            $object->casino_bonuses[$row["bonus_type_id"]] = $this->getCasinoBonusesInfo($object->id);
        }
        return $output;
    }
}