<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 02-May-19
 * Time: 1:22 PM
 */
require_once("entities/Casino.php");
require_once("queries/CasinosListQuery.php");
require_once("entities/BestLabel.php");
require_once("entities/BestLabelFilter.php");

class BestCasinoLabel
{
    const BEST_CASINO_LIMIT = 50;
    private $filter;

    public function __construct()
    {
        $this->filter = new BestLabelFilter();
        $this->filter->min_score = 8;
        $this->filter->is_open = 1;
        $this->filter->status_id = 0;
        $this->filter->min_vote = 1;
        $this->filter->sort_by[0] = 'score desc';
        $this->filter->sort_by[1] = 'priority desc';
        $this->filter->sort_by[2] = 'id desc';
    }

    // the main query that select the casino that should be 'Best'
    private function getMainQuery()
    {
        $order_by = implode(' , ',$this->filter->sort_by);

        $query = "Select id,name,is_open,status_id,priority,rating_total,rating_votes,(rating_total/rating_votes) as score 
        from casinos where is_open = ".$this->filter->is_open." and status_id = ".$this->filter->status_id." and (rating_total/rating_votes) >= ".$this->filter->min_score." order by " . $order_by . " limit " . self::BEST_CASINO_LIMIT ;

        return $query;
    }

    // return all the casinos that have the label 'Best'
    public function getAllBestCasinos()
    {
        $query = "SELECT casino_id,label_id FROM casinos__labels where label_id = 7";

        $output = array();

        $result = SQL($query);

        while($row = $result->toRow()){
            $bestCasinoLists = new BestLabel();
            $bestCasinoLists->casino_id = $row['casino_id'] ;
            $output[sizeof($output)] = $bestCasinoLists;
        }

        return $output;
    }

    // removes all casinos with the label id = 7 ('Best')
    public function resetAllBestCasinos()
    {
        $query = "Delete from casinos__labels where label_id = 7";
        SQL($query);
    }

    public function populateCasinoLabel()
    {
        $result = SQL($this->getMainQuery());
       // $output= array();

        while($row = $result->toRow()){
            $query = "INSERT INTO casinos__labels (casino_id, label_id) VALUES(" . $row['id']  . ",7)";
            SQL($query);
           // $output[sizeof($output)] = $row['id'];
        }

    }

    //checks if modified casino is best and in table
    public function checkCasino($casinoID){

        $result = SQL($this->getMainQuery());
        $output= array();

        $isBest = false;
        $inTable = false;

        //check casino is best
        while($row = $result->toRow()){
            if($row['id']== $casinoID) {
                $isBest = true;
                break;
            }
        }

        $query = "SELECT casino_id FROM casinos__labels where label_id = 7";
        $result = SQL($query);

        //check casino is in table
        while($row = $result->toRow()){
            if($row['id']== $casinoID) {
                $inTable = true;
                break;
            }
        }

        // if true then update table
        if($isBest!=$inTable)
        {
            $this->resetAllBestCasinos();
            $this->populateCasinoLabel();
        }
    }


}