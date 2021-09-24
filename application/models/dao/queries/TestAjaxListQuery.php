<?php

require_once("TestFiltersQuery.php");

/**
 * Class TestFiltersListQuery
 */
class TestFiltersListQuery extends TestFiltersQuery
{
    CONST LIMIT = 10;
    CONST OFFSET = 0;

    protected array $filtersData;
    private string $mainQuery;

    protected function setMainQueryBody(): void
    {
        $this->mainQuery = "
            SELECT 
                   t1.id, 
                   t1.code, 
                   t1.name 
            FROM casinos AS t1
            [WHERE_PLACEHOLDER]
            [ORDER_BY_PLACEHOLDER]
            [LIMIT_PLACEHOLDER]
        ";
    }

    protected function setWhere(): void
    {
        if(!empty($this->filtersData['where_condition'])){
            $whereCondition = "WHERE t1.is_open = 1";
            $this->mainQuery = str_replace("[WHERE_PLACEHOLDER]", $whereCondition, $this->mainQuery);
        }
        else{
            $this->mainQuery = str_replace("[WHERE_PLACEHOLDER]", "", $this->mainQuery);
        }
    }

    protected function setOrderBy(): void
    {
        $orderByCondition = "
               ORDER BY t1.name        
        ";
        $this->mainQuery = str_replace("[ORDER_BY_PLACEHOLDER]", $orderByCondition, $this->mainQuery);
    }


    protected function setLimit(): void
    {
        $offset = self::OFFSET;
        if(isset($this->filtersData['offset'])){
            $offset = (int) $this->filtersData['offset'];
        }
        $limit = self::LIMIT;
        $limitCondition = "LIMIT {$limit} OFFSET {$offset}";
        $this->mainQuery = str_replace("[LIMIT_PLACEHOLDER]", $limitCondition, $this->mainQuery);
    }

    public function getQuery(): string
    {
        return $this->mainQuery;
    }
}