<?php
namespace CasinosLists;


class GamesRecommendedQuery extends \Hlis\GameListRangeQuery
{
    protected function setWhere() {
        $where = $this->select->where();
        $where->set("t1.id", $this->condition->id, \Lucinda\Query\ComparisonOperator::DIFFERS);
        $where->set("t1.is_open", 1);
        $where->set("t2.is_open", 1);
        $where->set("t3.name", $this->condition->type->getCriteria()->name);
    }
}