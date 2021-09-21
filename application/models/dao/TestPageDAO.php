<?php
require_once("entities/TestDataCasino.php");
class TestPageDAO
{
    const LIMIT = 10;

    public function __construct(int $offset = 0, int $limit = self::LIMIT)
    {
        
    }

    public function getCasinosInfo(int $offset = 0, int $limit = self::LIMIT)
    {
        //$row = SQL("SELECT body_title, head_title, head_description FROM pages WHERE url=:url", array(":url"=>$url))->toRow();
        $resultSet = SQL("SELECT id, code, name FROM casinos ORDER BY name LIMIT :limit OFFSET :offset", array(":limit"=>$limit,":offset"=>$offset));
        $output = array();
        if ($row = $resultSet->toRow()) {
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
        $resultSet = SQL("SELECT t1.amount, t2.name AS bonus_type_name FROM casinos__bonuses AS t1 INNER JOIN bonus_types AS t2 WHERE t1.casino_id=:casino_id", array(":casino_id"=>$casionId));
        $casino_bonuses_info = array();
        if ($row = $resultSet->toRow()) {
            $object = new TestDataCasinoBonus();
            $object->bonus_type_id = $row["bonus_type_id"];
            $object->amount = $row["amount"];
            $object->bonus_type_name = $row["bonus_type_name"];
            $casino_bonuses_info[$casionId] = $object;
        }
        return $casino_bonuses_info;
    }
}