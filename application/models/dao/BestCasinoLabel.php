<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 02-May-19
 * Time: 1:22 PM
 */
require_once("entities/Casino.php");
require_once("entities/BestLabel.php");
require_once("entities/BestLabelFilter.php");

class BestCasinoLabel
{
    private $filter;
    private $from_sync;
    const BEST_CASINO_LIMIT = 50;

    public function __construct($sync = false)
    {
        $this->filter = new BestLabelFilter();
        $this->filter->min_score = 8;
        $this->filter->is_open = 1;
        $this->filter->status_id = 0;
        $this->filter->min_vote = 1;
        $this->filter->sort_by[0] = 'score desc';
        $this->filter->sort_by[1] = 'priority desc';
        $this->filter->sort_by[2] = 'id desc';
        $this->from_sync = $sync;
    }

    private function getAllBestCasinosQuery()
    {
        $order_by = implode(' , ', $this->filter->sort_by);

        $query = "SELECT id , (rating_total/rating_votes) as score
        FROM casinos WHERE is_open = ".$this->filter->is_open." AND status_id = ".$this->filter->status_id." AND (rating_total/rating_votes) >= ".$this->filter->min_score. " 
        ORDER BY " . $order_by . " 
        LIMIT " . self::BEST_CASINO_LIMIT ;

        return $query;
    }

    // Return a sorted(by score ASC) array of best casinos
    private function getAllBestCasinos()
    {
        if (!$this->from_sync) {
            $results = SQL($this->getAllBestCasinosQuery());
        } else {
            $results = DB::execute($this->getAllBestCasinosQuery());
        }
        $output = array();
        while ($row = $results->toRow()) {
            $best_casino_lists = new BestLabel();
            $best_casino_lists->casino_id = $row['id'] ;
            $output[sizeof($output)] = $best_casino_lists;
        }

        return $output;
    }

    // return an array of all the casinos that have the label 'Best'
    private function getAllBestLabels()
    {
        $query = "SELECT casino_id,label_id FROM casinos__labels WHERE label_id = 7";
        $result = SQL($query);
        $output = array();

        while ($row = $result->toRow()) {
            $best_casino_lists = new BestLabel();
            $best_casino_lists->casino_id = $row['casino_id'] ;
            $output[sizeof($output)] = $best_casino_lists;
        }

        return $output;
    }

    // populates casinos__label with the Best Casinos
    public function populateBestLabel()
    {
        $results = $this->getAllBestCasinos();

        foreach ($results as $arg) {
            if (!$this->from_sync) {
                SQL("INSERT INTO casinos__labels (casino_id,label_id) VALUE (" . $arg->casino_id . ",7)");
            } else {
                DB::execute("INSERT INTO casinos__labels (casino_id,label_id) VALUE (" . $arg->casino_id . ",7)");
            }
        }
    }

    // deletes all Best Casinos from casinos__label
    public function resetBestLabel()
    {
        SQL("DELETE FROM casinos__labels WHERE label_id = 7");
    }

    public function resetBestLabelFromSync()
    {
        DB::execute("DELETE FROM casinos__labels WHERE label_id = 7");
    }

    // checks if the rated casino should be inserted or deleted from Best
    public function checkRatedCasino($casino_id)
    {
        $is_best = $this->searchIfBest($this->getAllBestCasinos(), $casino_id);
        $in_table = $this->searchIfBest($this->getAllBestLabels(), $casino_id);

        if ($is_best!=$in_table) {
            $this->resetBestLabel();
            $this->populateBestLabel();
        }
    }

    private function searchIfBest($best_casinos, $id)
    {
        $found = false;
        foreach ($best_casinos as $arg) {
            if ($id == $arg->casino_id) {
                $found = true;
                break;
            }
        }
        return $found;
    }

    public function getBestLimit()
    {
        return self::BEST_CASINO_LIMIT;
    }
}
