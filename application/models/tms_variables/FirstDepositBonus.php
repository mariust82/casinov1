<?php
/**
 * Created by PhpStorm.
 * User: Alexandru.D
 * Date: 6/21/2018
 * Time: 4:48 PM
 */

class FirstDepositBonus extends \TMS\VariablesHolder {

    public function getBestInList(){
        $filterParams[$this->parameters["response"]->attributes("filter")] = $this->parameters["response"]->attributes("selected_entity");
        $filter = new CasinoFilter($filterParams, $this->parameters["response"]->attributes("country"));
        $object = new CasinosList($filter);

        $casino = $object->getResults(CasinoSortCriteria::TOP_RATED, 0, 1);
        if(!empty($casino[0]) && $casino[0]->bonus_first_deposit->amount){
            return $casino[0]->bonus_first_deposit->amount;
        }
    }

    public function getPopularInList(){
        $filterParams[$this->parameters["response"]->attributes("filter")] = $this->parameters["response"]->attributes("selected_entity");
        $filter = new CasinoFilter($filterParams, $this->parameters["response"]->attributes("country"));
        $object = new CasinosList($filter);

        $casino = $object->getResults(CasinoSortCriteria::POPULARITY, 0, 1);
        if(!empty($casino[0]) && $casino[0]->bonus_first_deposit->amount){
            return $casino[0]->bonus_first_deposit->amount;
        }
    }
    public function getNewestInList(){
        $filterParams[$this->parameters["response"]->attributes("filter")] = $this->parameters["response"]->attributes("selected_entity");
        $filter = new CasinoFilter($filterParams, $this->parameters["response"]->attributes("country"));
        $object = new CasinosList($filter);

        $casino = $object->getResults(CasinoSortCriteria::NEWEST, 0, 1);
        if(!empty($casino[0]) && $casino[0]->bonus_first_deposit->amount){
            return $casino[0]->bonus_first_deposit->amount;
        }
    }

}
