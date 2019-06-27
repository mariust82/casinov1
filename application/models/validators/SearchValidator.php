<?php
class SearchValidator extends  \Lucinda\RequestValidator\ParameterValidator{

    public function validate($value)
    {
        return (preg_match("/^[a-zA-Z0-9\-\s]+$/", $value)?$value:null);
    }
}