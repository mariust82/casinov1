<?php
require_once("vendor/lucinda/queries/plugins/MySQL/MySQLSelectGroup.php");

class MariaDBSelectGroup extends \Lucinda\Query\MySQLSelectGroup
{
    public function toString()
    {
        if (empty($this->contents)) {
            throw new Exception("running addSelect() method is mandatory");
        }
        $strOutput="";
        foreach ($this->contents as $objValue) {
            $strOutput.="\r\n".$objValue->toString()."\r\n"."\r\n".$this->operator."\r\n";
        }
        $strOutput = substr($strOutput, 0, -strlen($this->operator)-2);
        return $strOutput.
        ($this->orderBy && !$this->orderBy->isEmpty()?"\r\nORDER BY ".$this->orderBy->toString():"").
        ($this->limit?"\r\nLIMIT ".$this->limit->toString():"");
    }
}

