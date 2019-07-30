<?php


class ParentReviewValidator  extends \Lucinda\RequestValidator\ParameterValidator
{
    public function validate($value)
    {
        if ($value == 0) { // no parent
            return true;
        }

        $id = SQL("SELECT id FROM casinos__reviews WHERE id=:id", array(":id" => $value))->toValue();
        return !empty($id) ? $id : null;

    }
}