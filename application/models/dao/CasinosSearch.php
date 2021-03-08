<?php
require_once("AbstractSearch.php");
require_once("hlis/search/CasinoSearch.php");

class CasinosSearch extends AbstractSearch
{
    public function getResults($limit, $offset)
    {
        return SQL("
            SELECT name
            FROM casinos
            WHERE ".$this->getLike("name", Hlis\CasinoSearch::class)." AND is_open=1
            ORDER BY date_established DESC, name ASC
            LIMIT ".$limit." OFFSET ".$offset
        )->toColumn();
    }

    public function getTotal()
    {
        return (integer) SQL(
            "
            SELECT COUNT(id) AS nr 
            FROM casinos 
            WHERE ".$this->getLike("name", Hlis\CasinoSearch::class)." AND is_open=1"
        )->toValue();
    }
}
