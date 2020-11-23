<?php

class CountryNameValidator extends \Lucinda\RequestValidator\ParameterValidator
{
    public function validate($value)
    {
        if (empty($value)) {
            return null;
        }

       
        
        switch ($value) {
            case "holy-see-vatican-city-state":
                $value = "holy-see-(vatican-city-state)";
                break;
            case "sint-maarten-dutch-part":
                $value = "sint-maarten-(dutch-part)";
                break;
            case "democratic-peoples-republic-of-korea":
                $value = "democratic-people's-republic-of-korea";
                break;
            case "cocos-keeling-islands":
                $value = "cocos-(keeling)-islands";
                break;
            case "falkland-islands-malvinas":
                $value = "falkland-islands-(malvinas)";
                break;
            case "cote-divoire":
                $value = "cote-d'ivoire";
                break;
            case "lao-peoples-democratic-republic":
                $value = "lao-people's-democratic-republic";
                break;
        }
        
         if (!in_array($value, array("guinea-bissau","timor-leste"))) {
            $value = str_replace("-", " ", $value);
        }
        
        $id =  SQL("SELECT id FROM countries WHERE name=:name", array(":name"=>$value))->toValue();

        return !empty($id) ? $id : null;
    }
}
