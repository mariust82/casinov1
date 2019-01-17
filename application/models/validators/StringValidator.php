<?php

class StringValidator extends  \Lucinda\RequestValidator\ParameterValidator{

    public function validate($value)
    {
        return is_string($value) ? ($value != '' ? $value : true ) : null;
    }
}