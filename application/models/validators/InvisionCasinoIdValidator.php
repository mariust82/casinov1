<?php
/**
 * Created by PhpStorm.
 * User: Adrian.T
 * Date: 1/17/2019
 * Time: 1:57 PM
 */

class InvisionCasinoIdValidator extends \Lucinda\RequestValidator\ParameterValidator
{
    public function validate($value)
    {
        if (empty($value)) { // no parent
            return true;
        }

        $id = SQL("SELECT id FROM casinos__reviews WHERE invision_review_id=:invision_review_id", array(":invision_review_id" => $value))->toValue();
        return !empty($id) ? $id : null;

    }
}
