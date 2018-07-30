<?php
require_once("hlis/server_caching/src/CacheCriteriaKey.php");

class CasinosCounterKey extends CacheCriteriaKey
{
    protected function getCriteria() {
        return [CacheCriteria::CASINOS, CacheCriteria::SOFTWARES];
    }

    protected function getUniqueName($filters) {
        return "counter:".$filters[0];
    }
}