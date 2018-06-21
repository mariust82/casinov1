<?php
/**
 * Created by PhpStorm.
 * User: Alexandru.D
 * Date: 6/21/2018
 * Time: 4:48 PM
 */

class FirstDepositBonus extends \TMS\VariablesHolder {

    public function getBestInList(){
        $filterParams[$this->parameters["response"]->getAttribute("filter")] = $this->parameters["response"]->getAttribute("selected_entity");
        $filterParams["label"] = 'Best';
        $filter = new CasinoFilter($filterParams, $this->parameters["response"]->getAttribute("country"));
        $object = new CasinosList($filter);

        $casino = $object->getResults(CasinoSortCriteria::NONE, 0, 1);
        if($casino[0] && $casino[0]->bonus_first_deposit->amount){
            return $casino[0]->bonus_first_deposit->amount;
        }
    }

    public function getPopularInList(){
        $filterParams[$this->parameters["response"]->getAttribute("filter")] = $this->parameters["response"]->getAttribute("selected_entity");
        $filter = new CasinoFilter($filterParams, $this->parameters["response"]->getAttribute("country"));
        $object = new CasinosList($filter);

        $casino = $object->getResults(CasinoSortCriteria::POPULARITY, 0, 1);
        if($casino[0] && $casino[0]->bonus_first_deposit->amount){
            return $casino[0]->bonus_first_deposit->amount;
        }
    }
    public function getNewestInList(){
        $filterParams[$this->parameters["response"]->getAttribute("filter")] = $this->parameters["response"]->getAttribute("selected_entity");
        $filter = new CasinoFilter($filterParams, $this->parameters["response"]->getAttribute("country"));
        $object = new CasinosList($filter);

        $casino = $object->getResults(CasinoSortCriteria::NEWEST, 0, 1);
        if($casino[0] && $casino[0]->bonus_first_deposit->amount){
            return $casino[0]->bonus_first_deposit->amount;
        }
    }

}