<?php
class ReviewIdValidators extends \Lucinda\RequestValidator\ParameterValidator
{
    public function validate($value)
    {
        if (empty($value)) {
            return null;
        }

        $id =  SQL("SELECT id FROM casinos__reviews WHERE id=:id", array(":id"=>$value))->toValue();
        return !empty($id) ? $id : null;
    }
}
