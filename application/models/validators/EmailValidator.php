<?php
class EmailValidator extends \Lucinda\RequestValidator\ParameterValidator
{
    public function validate($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) ? $value : null;
    }
}
