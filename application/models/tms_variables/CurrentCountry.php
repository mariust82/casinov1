<?php
/**
 * Created by PhpStorm.
 * User: Alexandru.D
 * Date: 6/21/2018
 * Time: 11:00 AM
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/application/models/CasinoFilter.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/application/models/dao/CasinosList.php";
class CurrentCountry extends \TMS\VariablesHolder {

    public function getTotalCasinosAccepted() {
        $filterParams[$this->parameters["response"]->attributes()->get("filter")] = $this->parameters["response"]->attributes()->get("selected_entity");
        $filterParams["country_accepted"] = 1;
        $filter = new CasinoFilter($filterParams, $this->parameters["response"]->attributes()->get("country"));
        $object = new CasinosList($filter);

        return $object->getTotal();
    }

}