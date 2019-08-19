<?php

class GameTypeValidator extends \Lucinda\RequestValidator\ParameterValidator
{

    public function validate($value)
    {
        if ($value == 'classic-slots') {
            $value = 'slots';
        }
        if(empty($value))
            return null;

        $value = strtolower(str_replace("-"," ", $value));
        $id =  SQL("SELECT id FROM game_types WHERE name=:name",array(":name"=>$value))->toValue();
        return !empty($id) ? $id : null;
    }
}