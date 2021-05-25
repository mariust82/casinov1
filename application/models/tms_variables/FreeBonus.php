<?php
/**
 * Created by PhpStorm.
 * User: Alexandru.D
 * Date: 6/21/2018
 * Time: 11:04 AM
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/application/models/CasinoFilter.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/application/models/dao/CasinosList.php";

class FreeBonus extends \TMS\VariablesHolder
{
    public function getTotalFreeBonusCasinosInList()
    {
        $filterParams[$this->parameters["response"]->attributes("filter")] = $this->parameters["response"]->attributes("selected_entity");
        $filterParams["free_bonus"] = 1;
        $filter = new CasinoFilter($filterParams, $this->parameters["response"]->attributes("country"));
        $object = new CasinosList($filter);

        return $object->getTotal();
    }

    public function getTotalCasinos()
    {
        $query = "SELECT COUNT(DISTINCT casino_id) FROM `casinos__bonuses` WHERE bonus_type_id IN (3,4,5,6,11) AND deposit_minimum IN ('','0','$0','€0','£0')";
        return SQL($query)->toValue();
    }
}
