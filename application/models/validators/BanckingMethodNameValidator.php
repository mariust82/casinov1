<?php
class BanckingMethodNameValidator  extends \Lucinda\RequestValidator\ParameterValidator
{

    public function validate($value)
    {
        if(empty($value))
            return null;

        $v =  str_replace("-"," ", $value);
        $id =  DB("SELECT id FROM banking_methods WHERE name=:name",array(":name"=>$v))->toValue();

        return !empty($id) ? $value : null;

    }
}