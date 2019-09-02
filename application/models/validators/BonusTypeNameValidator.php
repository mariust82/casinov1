<?php

class BonusTypeNameValidator extends \Lucinda\RequestValidator\ParameterValidator
{
    public function validate($value)
    {
        if (empty($value)) {
            return null;
        }

        $v = str_replace("-", " ", $value);

        $id = SQL("SELECT id FROM bonus_types WHERE name=:name", array(":name"=>$v))->toValue();
        return !empty($id) ? $id : null;
    }
}
