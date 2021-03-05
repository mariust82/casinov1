<?php
class AbstractSearch
{
    protected $value;
    
    public function __construct($value = '')
    {
        $this->value = $value;
    }
    
    protected function getLike($column, $className) {
        $condition = "1";
        if ($this->value) {
            $object = new $className($this->value);
            if ($object->isMatchAgainst()) {
                $condition = "MATCH(".$column.") AGAINST ('".$object->getPattern()."' IN BOOLEAN MODE)";
            } else {
                $condition = $column." LIKE '".$object->getPattern()."'";
            }
        }
        return $condition;
    }
}

