<?php
class ListSearchResults
{
    private $offset;
    private $limit;
    private $results = [];
    private $skipCounter = 0;
    
    public function __construct($offset =0, $limit =0) {
        $this->offset = $offset;
        $this->limit = $limit;
    }
    
    public function add($results) {
        foreach($results as $v) {
            if ($this->offset) {
                if($this->skipCounter<$this->offset) {
                    $this->skipCounter ++;
                    continue;
                }
            }
            $this->results[] = $v;
            if ($this->limit) {
                if (sizeof($this->results)==$this->limit) {
                    return false;
                }
            }
        } 
        return true;
    }
    
    public function get() {
        return $this->results;
    }
}
