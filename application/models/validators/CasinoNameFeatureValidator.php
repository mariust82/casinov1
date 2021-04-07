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
            case "ecogra casinos":
                return "eCOGRA Casinos";
            default:
                return null;
        }
    }
}
