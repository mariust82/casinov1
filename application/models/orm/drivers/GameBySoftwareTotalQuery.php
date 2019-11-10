<?php
namespace CasinosLists;

class GameBySoftwareTotalQuery extends \Hlis\GameListTotalQuery
{
    protected function setWhere()
    {
        $where = $this->select->where();
        $where->set("t2.id", $this->condition->id);
    }
}
