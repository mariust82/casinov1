<?php

class SoftwareNameValidator extends \Lucinda\RequestValidator\ParameterValidator
{

    public function validate($value)
    {
        $value = str_replace("-"," ", $value);
        $id = SQL("SELECT id FROM game_manufacturers WHERE name=:name",array(":name"=>$value))->toValue();
        return !empty($id) ? $id : null;
    }
}