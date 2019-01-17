<?php
class CasinoLabelValidator extends \Lucinda\RequestValidator\ParameterValidator
{

    public function validate($value)
    {
        if(empty($value))
            return null;

        if($value == 'mobile')
            return 'Mobile';

        $v =  str_replace("-"," ", $value);
        $id = DB("SELECT id FROM casino_labels WHERE name=:name",array(":name"=>$v))->toValue();

        return !empty($id) ? $id : null;
    }
}