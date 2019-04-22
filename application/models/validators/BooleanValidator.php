<?php
class BooleanValidator extends  \Lucinda\RequestValidator\ParameterValidator{


    public function validate($value){
        switch ($value){
            case 1:
            case '1':
            case 0:
            case '0':
            case 'true':
            case true:
            case false:
            case 'false':
                return true;
        }

        return null;
    }

}