<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 14-May-19
 * Time: 12:04 PM
 */
require_once ("entities/Casino.php");
require_once ("entities/LowWageringLabelFilter.php");
require_once ("entities/LowWageringLabel.php");

class LowWageringCasinoLabel
{
    private $filter;
    const LOW_WAGERING_CASINO_LIMIT = 100;

    public function __construct()
    {
        $this->filter = new LowWageringLabelFilter();
        $this->filter->is_open = 1;
        $this->filter->status_id = 1;
        $this->filter->max_wager = 25;
        $this->filter->bonus_types = array(3,4,5,6);
        $this->filter->sort_by = array("CAST(t2.wagering as UNSIGNED) ASC","t1.priority DESC","t1.id DESC");
        $this->filter->label_id = 10;
    }

    //query for selecting all low wagering casinos
    private function lowWageringCasinosQuery()
    {
        $query = "SELECT t1.id , t1.name , t1.is_open , t1.status_id , t1.priority , t2.bonus_type_id , t2.wagering
        FROM casinos AS t1 
        INNER JOIN casinos__bonuses AS t2 ON t1.id = t2.casino_id
        WHERE t1.is_open = ". $this->filter->is_open ." AND t1.status_id != ". $this->filter->status_id ." AND t2.bonus_type_id IN (". implode(',',$this->filter->bonus_types) .") AND CAST(t2.wagering AS UNSIGNED) <= ". $this->filter->max_wager ."
        ORDER BY ". implode(',',$this->filter->sort_by) ;//." LIMIT " . self::LOW_WAGERING_CASINO_LIMIT;

        return $query;
    }

    //gets and processes all low wagering casinos
    private function getAllLowWageringCasinoLabel()
    {
        $result =  DB::execute($this->lowWageringCasinosQuery());
        $output = array();

        while($row=$result->toRow())
        {
            $casinos = new LowWageringLabel();
            $casinos->id = $row['id'];
            $casinos->bonus_types = $row['bonus_type_id'];
            $casinos->wagering = $row['wagering'];
            $output[sizeof($output)] = $casinos;
        }

        return $output;
    }

    //populates all low wagering casinos
    public function populateLowWageringLabel()
    {
        $result = $this->getAllLowWageringCasinoLabel();

        foreach ($result as $casino)
            DB::execute("INSERT INTO casinos__labels (casino_id,label_id) VALUE (" . $casino->id . ",".$this->filter->label_id.")");
    }

    //resets all low wagering casinos
    public function resetLowWageringLabel()
    {
        DB::execute("DELETE FROM casinos__labels WHERE label_id = ".$this->filter->label_id);
    }
}