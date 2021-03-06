<?php

require_once 'application/models/tms_variables/NoDepositBonusTms/NoDepositBonusInterface.php';
require_once 'application/models/CasinoFilter.php';
require_once 'application/models/CasinoSortCriteria.php';
require_once 'application/models/dao/entities/Country.php';
require_once 'application/models/dao/CasinosList.php';

class NoDepositBonusData implements NoDepositBonusInterface
{
    private $country;

    public function __construct($country)
    {
        $this->country = $country;
    }

    public function setFilter($filter)
    {
        $this->filter = new CasinoFilter($filter, $this->country);
    }

    public function getData($sortCriteria)
    {
        $casino = new CasinosList($this->filter);
        return $casino->getResults($sortCriteria, null, 1);
    }
}
