<?php
/**
 * Created by PhpStorm.
 * User: Alexandru.D
 * Date: 6/21/2018
 * Time: 11:04 AM
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/application/models/CasinoFilter.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/application/models/dao/CasinosList.php";

class FreeBonus extends \TMS\VariablesHolder {

    public function getTotalFreeBonusCasinosInList(){
        $filterParams[$this->parameters["response"]->attributes()->get("filter")] = $this->parameters["response"]->attributes()->get("selected_entity");
        $filterParams["free_bonus"] = 1;
        $filter = new CasinoFilter($filterParams, $this->parameters["response"]->attributes()->get("country"));
        $object = new CasinosList($filter);

        return $object->getTotal();
    }

    public function getTotalCasinos() {
        $query = "SELECT COUNT(*) FROM `casinos__bonuses` WHERE bonus_type_id IN (3,4,5,6,11) AND minimum_deposit IN ('','0','$0','€0','£0')";
        return SQL($query)->toValue();
    }

}