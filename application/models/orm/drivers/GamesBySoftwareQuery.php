<?php
namespace CasinosLists;

class GamesBySoftwareQuery extends \Hlis\GameListRangeQuery
{
    protected function setWhere()
    {
        $where = $this->select->where();
        var_dump($this->condition->manufacturer);
        $where->set("t2.id", $this->condition->manufacturer);
    }
}
