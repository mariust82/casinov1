<?php
require_once("AbstractSearch.php");
require_once("hlis/search/Search.php");

class GamesSearch extends AbstractSearch
{
    public function getResults($limit, $offset)
    {
        return SQL(
            "
            SELECT name
            FROM games
            WHERE ".$this->getLike("name", \Hlis\Search::class)."
            ORDER BY id DESC, name ASC
            LIMIT ".$limit." OFFSET ".$offset
        )->toColumn();
    }

    public function getTotal()
    {
        // build query
        return (integer) SQL(
            "
            SELECT COUNT(id) AS nr FROM games WHERE ".$this->getLike("name", \Hlis\Search::class)
        )->toValue();
    }
}
