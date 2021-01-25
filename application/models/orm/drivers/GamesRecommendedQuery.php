<?php
namespace CasinosLists;

class GamesRecommendedQuery extends \Hlis\GameListRangeQuery
{
    public function __construct(GameFields $fields, GameCondition $condition, GameSort $sort, $offset, $limit) {
        $this->fields = $fields->getCriteria();
        $this->condition = $condition->getCriteria();
        $this->sort = $sort->getCriteria();
        $this->sortOrder = $sort->getOrder();
        $this->offset = $offset;
        $this->limit = $limit;
        
        $this->select = new \Lucinda\Query\MySQLSelect("games", "t1");
        $this->select->setStraightJoin();
        $this->setFields();
        $this->setJoins();
        $this->setWhere();
        $this->setOrderBy();
        $this->setLimit();
    }
    protected function setWhere()
    {
        $where = $this->select->where();
        $where->set("t1.id", $this->condition->id, \Lucinda\Query\ComparisonOperator::DIFFERS);
        $where->set("t1.is_open", 1);
        $where->set("t2.is_open", 1);
        $where->set("t3.name", $this->condition->type->getCriteria()->name);
    }
}
