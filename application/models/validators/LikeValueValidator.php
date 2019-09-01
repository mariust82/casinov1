<?php
/**
 * Created by PhpStorm.
 * User: Alexandru.D
 * Date: 2/4/2019
 * Time: 1:23 PM
 */

class LikeValueValidator extends Lucinda\RequestValidator\ParameterValidator {

    public function validate($string) {
        $accepted = [0,1];
        return in_array($string, $accepted) ? true : null;
    }

}