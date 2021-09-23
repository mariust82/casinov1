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
    private $mainQuery;

    protected function setMainQueryBody(): void
    {
        $this->mainQuery = "
            SELECT 
                   t1.id,
                   t1.code,
                   t1.name
            FROM casinos AS t1
            INNER JOIN casinos__bonuses AS t2
                ON t1.id = t2.casino_id
            INNER JOIN bonus_types AS t3    
                ON t2.bonus_type_id = t3.id
            WHERE 1
                [WHERE_PLACEHOLDER]
            GROUP BY t1.id
            [LIMIT_PLACEHOLDER]
        ";
    }

    protected function setWhere(): void
    {
        foreach($this->filtersData['filter_parameters'] as $sFilterName=>$mFilterData){
            $sAdditionalWhereCondition = "";
            if($sFilterName=='labels'){
                foreach($mFilterData as $sLabelValue){
                    if($sLabelValue=='exc'){
                        $sAdditionalWhereCondition .= "
                            AND t2.is_exclusive = 1 
                        ";
                    }
                    elseif ($sLabelValue=='new'){
                        $sAdditionalWhereCondition .= "
                            AND t2.date_modified > '2020-02-26 06:59:42'
                        ";
                    }
                }
            }
            elseif ($sFilterName=='free_bonus'){
                $sAdditionalWhereCondition .= "
                    AND t3.name IN ('No Deposit Bonus')
                ";
            }
            elseif ($sFilterName=='country_accepted'){
                $sAdditionalWhereCondition .= "";  //have no table relation about this
            }

            $this->mainQuery = str_replace("[WHERE_PLACEHOLDER]", $sAdditionalWhereCondition, $this->mainQuery);
        }
    }

    protected function setOrderBy(): void
    {
        $orderByCondition = "
                t1.name ASC,
                t2.bonus_type_id DESC        
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
        /*echo "<pre>";
        print_r($this->mainQuery);
        die();*/
    }

    /**
     * Get query string.
     *
     * @return string
     */
    public function getQuery(): string
    {
        return $this->mainQuery;
    }
}