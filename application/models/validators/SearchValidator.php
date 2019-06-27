<?php
class SearchValidator extends  \Lucinda\RequestValidator\ParameterValidator{

    public function validate($value)
    {
        return (!$value || preg_match("/^[a-zA-Z0-9\-\s]+$/", $value)?$value:null);
    }
}
