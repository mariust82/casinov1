<?php
class GameNameValidator extends \Lucinda\RequestValidator\ParameterValidator
{
    public function validate($value)
    {
        if (empty($value)) {
            return null;
        }
        $value = str_replace("-", " ", $value);
        $id =  SQL("SELECT id FROM games WHERE name=:name", array(":name"=>$value))->toValue();
        return !empty($id) ? $id : null;
    }
}
