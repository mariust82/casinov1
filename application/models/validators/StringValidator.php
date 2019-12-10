<?php

class StringValidator extends \Lucinda\RequestValidator\ParameterValidator
{
    public function validate($value)
    {
        var_dump($value);
        var_dump(is_string($value) ? ($value != '' ? $value : true) : null);
        return is_string($value) ? ($value != '' ? $value : true) : null;
    }
}
