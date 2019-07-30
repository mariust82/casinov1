<?php

class SoftwareNameValidator extends \Lucinda\RequestValidator\ParameterValidator
{
    public function validate($value)
    {
        $value = str_replace("-"," ", $value);
        $softwares = explode(",",$value);
        $condition = "(";
        foreach ($softwares as $name)
            $condition = $condition . "'".$name."',";
        $condition[strlen($condition)-1] = ")";
        $query = "SELECT id FROM game_manufacturers WHERE name IN ". $condition;
        $id = SQL($query)->toValue();
        return !empty($id) ? $id : null;
    }
}