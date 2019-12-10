<?php

class StringValidator extends \Lucinda\RequestValidator\ParameterValidator
{
    public function validate($value)
    {
        var_dump($value);
        return is_string($value) ? ($value != '' ? $value : true) : null;
    }
}
