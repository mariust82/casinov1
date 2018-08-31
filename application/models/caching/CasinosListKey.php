<?php
//require_once("hlis/server_caching/src/CacheCriteriaKey.php");

class CasinosListKey extends CacheCriteriaKey
{
    protected function getCriteria() {
        return [CacheCriteria::CASINOS, CacheCriteria::SOFTWARES];
    }

    protected function getUniqueName($filters) {
        return "list:".json_encode($filters);
    }
}