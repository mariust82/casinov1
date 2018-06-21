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
        $filterParams[$this->parameters["response"]->getAttribute("filter")] = $this->parameters["response"]->getAttribute("selected_entity");
        $filterParams["free_bonus"] = 1;
        $filter = new CasinoFilter($filterParams, $this->parameters["response"]->getAttribute("country"));
        $object = new CasinosList($filter);

        return $object->getTotal();
    }

    public function getTotalCasinos(){
        $freeBonusCount = DB("
        SELECT COUNT(t1.casino_id) 
        FROM casinos__bonuses AS t1
        INNER JOIN bonus_types AS t2 ON t1.bonus_type_id = t2.id
        WHERE t2.name IN ('No Deposit Bonus','First Deposit Bonus','Free Spins','Free Play')
        ")->toValue();

        return $freeBonusCount;
    }

}