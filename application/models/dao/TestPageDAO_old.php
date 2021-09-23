<?php
require_once("entities/TestDataCasino.php");
require_once("entities/TestDataCasinoBonus.php");

class TestPageDAO
{
    private $actionType;
    private $resultSet;

    private $limit = 10;  //this should not be modified from the interface
    private $offset = 0;
    private $filter_parameters = array();


    public function __construct(string $actionType='initial_load', array $aRequestParameters=array())
    {
        $this->actionType = $actionType;
        $this->setRequestData($aRequestParameters);
        //$this->setQuery();
    }

    private function setRequestData(array $aRequestParameters)
    {
        if($this->actionType=='filters_load'){
            $this->preFetch($aRequestParameters);
        }
    }

    private function preFetch(array $aRequestParameters)
    {
        foreach ($aRequestParameters as $k => $v) {
            if (isset($this->$k)) {
                $this->$k = $v;
            }
        }
        /*echo "<pre>";
        print_r($this->filter_parameters);
        die();*/
    }

    public function getCasinosInfo()
    {
        //$this->query = SQL("SELECT id, code, name FROM casinos ORDER BY name LIMIT :limit OFFSET :offset", array("limit"=>$this->limit, "offset"=>$this->offset));  //error: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''10' OFFSET '0'' at line 1
        $resultSet = SQL("SELECT id, code, name FROM casinos ORDER BY name LIMIT ".$this->limit." OFFSET ".$this->offset);
        $output = array();
        while ($row = $resultSet->toRow()) {
            $object = new TestDataCasino();
            $object->id = $row["id"];
            $object->code = $row["code"];
            $object->name = $row["name"];
            $object->casino_bonuses =  $this->getCasinoBonusesInfo($object->id);
            $output[$object->id] = $object;
            echo "<pre>";
            print_r($output);
            die();
        }
        //echo "<pre>";
        //print_r($output);
        //die();
        return $output;
    }

    private function getCasinoBonusesInfo(int $casionId)
    {
        $this->setResultSet($casionId);
        $casino_bonuses_info = array();
        while ($row = $this->resultSet->toRow()) {
            $object = new TestDataCasinoBonus();
            $object->bonus_type_id = $row["bonus_type_id"];
            $object->amount = $row["amount"];
            $object->bonus_type_name = $row["bonus_type_name"];
            $casino_bonuses_info[] = $object;
        }
        return $casino_bonuses_info;
    }

    private function setResultSet(int $casionId)
    {
        if ($this->actionType=='initial_load'){
            $this->setInitialLoadResultSet($casionId);
        }
        elseif ($this->actionType=='filters_load'){
            $this->setActiveFiltersResultSet($casionId);
        }
    }

    private function setInitialLoadResultSet(int $casionId)
    {
        $this->resultSet = SQL("
                SELECT 
                       t1.amount, 
                       t2.name AS bonus_type_name,
                       t1.bonus_type_id
                FROM casinos__bonuses AS t1 
                INNER JOIN bonus_types AS t2    
                    ON t1.bonus_type_id = t2.id
                WHERE t1.casino_id=:casino_id
                    AND t2.name IN ('First Deposit Bonus', 'No Deposit Bonus')
                ORDER BY t1.bonus_type_id DESC
                ", array(":casino_id"=>$casionId)
        );
    }

    private function setActiveFiltersResultSet(int $casionId)
    {
        //$boundParameters = array(":casino_id"=>$casionId);

        $sAdditionalWhereCondition = "";
        foreach($this->filter_parameters as $sFilterName=>$mFilterData){
            if($sFilterName=='labels'){
                foreach($mFilterData as $sLabelValue){
                    if($sLabelValue=='exc'){
                        $sAdditionalWhereCondition .= "
                            AND t1.is_exclusive = 1 
                        ";
                    }
                    elseif ($sLabelValue=='new'){
                        $sAdditionalWhereCondition .= "
                            AND t1.date_modified > '2020-02-26 06:59:42'
                        ";
                    }
                }
            }
            elseif ($sFilterName=='free_bonus'){
                $sAdditionalWhereCondition .= "
                    AND t2.name IN ('No Deposit Bonus')
                ";
            }
            elseif ($sFilterName=='country_accepted'){
                $sAdditionalWhereCondition .= "";
            }
        }
        //echo $sAdditionalWhereCondition;die();

        $this->resultSet = SQL("
                SELECT 
                       t1.amount, 
                       t2.name AS bonus_type_name,
                       t1.bonus_type_id
                FROM casinos__bonuses AS t1 
                INNER JOIN bonus_types AS t2    
                    ON t1.bonus_type_id = t2.id
                WHERE t1.casino_id=:casino_id
                    AND t2.name IN ('First Deposit Bonus', 'No Deposit Bonus')
                    {$sAdditionalWhereCondition}
                ORDER BY t1.bonus_type_id DESC
                ", array(":casino_id"=>$casionId)
        );

    }
}