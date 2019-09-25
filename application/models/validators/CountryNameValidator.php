<?php

class CountryNameValidator extends \Lucinda\RequestValidator\ParameterValidator
{
    public function validate($value)
    {
        if (empty($value)) {
            return null;
        }

        if (!in_array($value, array("guinea-bissau","timor-leste"))) {
            $value = str_replace("-", " ", $value);
        }

        $id =  SQL("SELECT id FROM countries WHERE name=:name", array(":name"=>$value))->toValue();

        return !empty($id) ? $id : null;
    }
}
