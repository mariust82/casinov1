<?php

require_once 'application/models/tms_variables/NoDepositBonusTms/NoDepositBonusInterface.php';

class NoDepositBonusData implements  NoDepositBonusInterface{

    private $filter = [];
    private $country ='';

    public function __construct($country){

        $this->country = $country;

    }

    public function setFilter($filter)
    {
        $this->filter = new CasinoFilter($filter, $this->country);
    }

    function getData($sortCriteria )
    {
        $casino = new CasinosList($this->filter);
        $casino_data =  $casino->getResults($sortCriteria, null, 1);
        return $casino_data;
    }
}