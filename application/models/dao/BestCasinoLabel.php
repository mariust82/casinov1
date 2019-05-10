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
require_once("CasinosList.php");

class BestCasinoLabel
{
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

    /*private function getMainQuery()
    {
        $order_by = implode(' , ',$this->filter->sort_by);

        $query = "SELECT id
        FROM casinos WHERE is_open = ".$this->filter->is_open." AND status_id = ".$this->filter->status_id." AND (rating_total/rating_votes) >= ".$this->filter->min_score. " 
        ORDER BY " . $order_by . " 
        LIMIT " . self::BEST_CASINO_LIMIT ;

        return $query;
    }*/

    // return all the casinos that have the label 'Best'
    public function getAllBestCasinos()
    {
        $query = "SELECT casino_id,label_id FROM casinos__labels WHERE label_id = 7";

        $output = array();

        $result = SQL($query);

        while($row = $result->toRow()){
            $bestCasinoLists = new BestLabel();
            $bestCasinoLists->casino_id = $row['casino_id'] ;
            $output[sizeof($output)] = $bestCasinoLists;
        }

        return $output;
    }

    public function getBestCriteria()
    {
        $sub_query = $this->filter->status_id ." AND (t1.rating_total/t1.rating_votes) >= ".$this->filter->min_score ;
        return $sub_query;
    }
}