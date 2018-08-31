<?php
//require_once("hlis/server_caching/src/CacheCriteriaKey.php");

class GamesCounterKey extends CacheCriteriaKey
{
    protected function getCriteria() {
        return [CacheCriteria::GAMES, CacheCriteria::SOFTWARES];
    }

    protected function getUniqueName($filters) {
        return "counter";
    }
}