<?php

class CasinoNameFeatureValidator extends \Lucinda\RequestValidator\ParameterValidator
{
    public function validate($value)
    {
        if (empty($value)) {
            return null;
        }
        $value = strtolower(str_replace("-", " ", $value));
        switch ($value) {
            case "live dealer":
                return "Live Dealer";
                break;
            case "ecogra casinos":
                return "eCOGRA Casinos";
                break;
            default:
                return null;
                break;
        }
    }
}
