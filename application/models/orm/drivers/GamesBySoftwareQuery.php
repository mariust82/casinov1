<?php
namespace CasinosLists;

class GamesBySoftwareQuery extends \Hlis\GameListRangeQuery
{
    protected function setWhere()
    {
        $where = $this->select->where();
        $where->set("t2.id", $this->condition->id);
    }
}
