<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 08-Jul-19
 * Time: 5:03 PM
 */

require_once("entities/NoAccountLabelFilter.php");

class NoAccountLabel
{
    private $filter;
    private $from_sync;
    const NO_ACCOUNT_LIMIT = 100;

    public function __construct()
    {
        $this->filter = new NoAccountLabelFilter();
        $this->filter->is_open = 1;
        $this->filter->no_registration = 1;
        $this->filter->sort_by[0] = 'priority DESC';
        $this->filter->sort_by[1] = 'date_established DESC';
        $this->filter->label_id = 11;
    }

    public function resetNoAccountLabel(){
        SQL("DELETE FROM casinos__labels WHERE label_id = 11");
    }

    public function resetNoAccountLabelFromSync(){
        DB::execute("DELETE FROM casinos__labels WHERE label_id = 11");
    }

    public function getMainQuery(){
        $order_by = implode(",",$this->filter->sort_by);

        $query="SELECT id FROM casinos WHERE no_registration = ". $this->filter->is_open ."  AND no_registration = " . $this->filter->no_registration . "
         ORDER BY ". $order_by ." LIMIT  ". self::NO_ACCOUNT_LIMIT ;

        return $query;
    }

    private function getAllNoAccountCasinos(){

        $results = DB::execute($this->getMainQuery());
        $id = [];

        while($row = $results->toRow()){
            $id[sizeof($id)] = $row['id'];
        }

        return $id;
    }

    public function insertALabel($casinoID){
        DB::execute("INSERT IGNORE INTO casinos__labels (casino_id,label_id) VALUE (" . $casinoID . ",".$this->filter->label_id.")");
    }

    public function populateNoAccountLabel(){

        $results = $this->getAllNoAccountCasinos();

        foreach ($results as $casino)
            DB::execute("INSERT IGNORE INTO casinos__labels (casino_id,label_id) VALUE (" . $casino->id . ",".$this->filter->label_id.")");

    }


}