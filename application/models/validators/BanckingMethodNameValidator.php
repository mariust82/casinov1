<?php
class BanckingMethodNameValidator extends \Lucinda\RequestValidator\ParameterValidator
{
    public function validate($value)
    {
        if (empty($value)) {
            return null;
        }

        $v =  str_replace("-", " ", $value);
        $name =  SQL("SELECT name FROM banking_methods WHERE name=:name", array(":name"=>$v))->toValue();

        return !empty($name) ? $name : null;
    }
}
