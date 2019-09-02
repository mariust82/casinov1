<?php

require_once 'application/models/tms_variables/NoDepositBonusTms/NoDepositBonusData.php';


class NoDepositBonus extends \TMS\VariablesHolder
{
    private $bonus_type = 'No Deposit Bonus';

    private function getCountry()
    {
        $country =  !empty($this->parameters["response"]->attributes("country")) ?  $this->parameters["response"]->attributes("country") : '';
        return $country;
    }

    public function newestInCurentList()
    {
        $filterParams = [];
        $filterPage = !empty($this->parameters["response"]->attributes("filter")) ? $this->parameters["response"]->attributes("filter") : null;
        $country = $this->getCountry();

        if (empty($filterPage)) {
            return '';
        }

        $filterParams[$filterPage] = $this->parameters["response"]->attributes("selected_entity");
        $filterParams['bonus_type']  = $this->bonus_type;

        $newestNoDepInTheList = new NoDepositBonusData($country);
        $newestNoDepInTheList->setFilter($filterParams);

        $casino =  $newestNoDepInTheList->getData(CasinoSortCriteria::NEWEST);
        $bonus_type_value = !empty($casino[0]->bonus_free->amount) ? $casino[0]->bonus_free->amount : '';

        return $bonus_type_value ;
    }

    public function newestInTheSite()
    {
        $filterParams = [];
        $country = $this->getCountry();
        $filterParams['bonus_type'] = $this->bonus_type;
        $newestNoDepInTheSite = new NoDepositBonusData($country);
        $newestNoDepInTheSite->setFilter($filterParams);
        $casino =  $newestNoDepInTheSite->getData(CasinoSortCriteria::NEWEST);

        $bonus_type_value = !empty($casino[0]->bonus_free->amount) ?  $casino[0]->bonus_free->amount : '';
        return  $bonus_type_value;
    }


    public function bestInCurrentList()
    {
        $filterParams = [];
        $country = $this->getCountry();
        $filterPage = !empty($this->parameters["response"]->attributes("filter")) ? $this->parameters["response"]->attributes("filter") : '';

        if (empty($filterPage)) {
            return '';
        }

        $filterParams[$filterPage] = $this->parameters["response"]->attributes("selected_entity");
        $filterParams['bonus_type']  = $this->bonus_type;

        $newestNoDepInTheList = new NoDepositBonusData($country);
        $newestNoDepInTheList->setFilter($filterParams);

        $casino =  $newestNoDepInTheList->getData(CasinoSortCriteria::TOP_RATED);
        $bonus_type_value = !empty($casino[0]->bonus_free->amount) ?  $casino[0]->bonus_free->amount : '';
        return $bonus_type_value;
    }

    public function bestInSite()
    {
        $filterParams = [];

        $country = $this->getCountry();
        $filterParams['bonus_type'] = $this->bonus_type;
        $newestNoDepInTheSite = new NoDepositBonusData($country);
        $newestNoDepInTheSite->setFilter($filterParams);
        $casino =  $newestNoDepInTheSite->getData(CasinoSortCriteria::TOP_RATED);
        $bonus_type_value = !empty($casino[0]->bonus_free->amount) ?  $casino[0]->bonus_free->amount : '';

        return  $bonus_type_value;
    }
}
