<?php

class IntegerValidator extends \Lucinda\RequestValidator\ParameterValidator
{
    public function validate($value)
    {
        if ($value == 0) {
            return true;
        }

        return is_int((int)$value) ? $value : null;
    }
}
