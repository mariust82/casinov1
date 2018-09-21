<?php

require_once("application/models/CasinoFilter.php");
require_once("application/models/dao/CasinosList.php");
require_once("application/models/CasinoSortCriteria.php");

class Visits extends \TMS\VariablesHolder {
    public function getNewestGameTotal() {
        $query = "SELECT times_played FROM games ORDER BY date DESC LIMIT 1";
        return DB($query)->toValue();
    }

    public function getBestGameTotal() {
        $query = "SELECT times_played FROM games ORDER BY times_played DESC LIMIT 1";
        return DB($query)->toValue();
    }

    public function getBestCasinoTotal() {
        $country = $this->getCountry();
        $filter = new CasinoFilter(['label' => 'best'], $country);
        $casinos = new CasinosList($filter);

        $result = $casinos->getResults(CasinoSortCriteria::TOP_RATED,1, 5);
        return $result[0]->clicks;
    }

    public function getNewestCasinoTotal() {
        $country = $this->getCountry();
        $filter = new CasinoFilter(['label' => 'new'], $country);
        $casinos = new CasinosList($filter);
        $result = $casinos->getResults(CasinoSortCriteria::NEWEST, 1, 1);

        return $result[0]->clicks;
    }

    private function getCountry() {
        return $this->parameters['response']->getAttribute('country');
    }
}