<?php

class CasinoIdValidator extends \Lucinda\RequestValidator\ParameterValidator
{

    public function validate($value)
    {

        if (empty($value)) {
            return null;
        }

        $id = DB("SELECT id FROM casinos WHERE id=:id", array(":id" => $value))->toValue();
        return !empty($id) ? $id : null;
    }
}