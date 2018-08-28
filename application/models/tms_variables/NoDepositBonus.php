<?php

require_once 'application/models/tms_variables/NoDepositBonusTms/NoDepositBonusData.php';


class  NoDepositBonus extends \TMS\VariablesHolder {

    private function getCountry(){

        $country =  !empty( $this->parameters["response"]->getAttribute("country")) ?  $this->parameters["response"]->getAttribute("country") : '';
        return $country;

    }

    public function newestInCurentList(){

        $filterPage = !empty($this->parameters["response"]->getAttribute("filter")) ? $this->parameters["response"]->getAttribute("filter") : null;
        $country = $this->getCountry();


        if(empty($filterPage)){
            return '';
        }

        $filterParams[$filterPage] = $this->parameters["response"]->getAttribute("selected_entity");
        $filterParams['bonus_type']  = 'No Deposit Bonus';

        $newestNoDepInTheList = new NoDepositBonusData($country);
        $newestNoDepInTheList->setFilter($filterParams);

         $casino =  $newestNoDepInTheList->getData(CasinoSortCriteria::NEWEST);
         $bonus_type_value = !empty($casino[0]->bonus_first_deposit->amount) ? $casino[0]->bonus_first_deposit->amount : '';

        return $bonus_type_value ;
    }

    public function newesInTheSite(){

        $country = $this->getCountry();
        $filterParams['bonus_type'] = 'No Deposit Bonus';
        $newestNoDepInTheSite = new NoDepositBonusData($country);
        $newestNoDepInTheSite->setFilter($filterParams);
        $casino =  $newestNoDepInTheSite->getData(CasinoSortCriteria::NEWEST);

        $bonus_type_value = !empty($casino[0]->bonus_first_deposit->amount) ?  $casino[0]->bonus_first_deposit->amount : '';
        return  $bonus_type_value;

    }


    public function bestInCurrentList(){

        $country = $this->getCountry();
        $filterPage = !empty($this->parameters["response"]->getAttribute("filter")) ? $this->parameters["response"]->getAttribute("filter") : '';

        if(empty($filterPage)){
            return '';
        }

        $filterParams[$filterPage] = $this->parameters["response"]->getAttribute("selected_entity");
        $filterParams['bonus_type']  = 'No Deposit Bonus';

        $newestNoDepInTheList = new NoDepositBonusData($country);
        $newestNoDepInTheList->setFilter($filterParams);

        $casino =  $newestNoDepInTheList->getData(CasinoSortCriteria::TOP_RATED);
        $bonus_type_value = !empty($casino[0]->bonus_first_deposit->amount) ?  $casino[0]->bonus_first_deposit->amount : '';
        return $bonus_type_value;

    }

    public function bestInSite(){

        $country = $this->getCountry();
        $filterParams['bonus_type'] = 'No Deposit Bonus';
        $newestNoDepInTheSite = new NoDepositBonusData($country);
        $newestNoDepInTheSite->setFilter($filterParams);
        $casino =  $newestNoDepInTheSite->getData(CasinoSortCriteria::TOP_RATED);

        $bonus_type_value = !empty($casino[0]->bonus_first_deposit->amount) ?  $casino[0]->bonus_first_deposit->amount : '';

        return  $bonus_type_value;

    }



}