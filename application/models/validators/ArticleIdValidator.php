<?php
/**
 * Created by PhpStorm.
 * User: Alexandru.D
 * Date: 2/1/2019
 * Time: 6:05 PM
 */

class ArticleIdValidator extends Lucinda\RequestValidator\ParameterValidator{

    public function validate($id)
    {
        $results = SQL("SELECT id
            FROM `articles`
            WHERE articles.id=:id
            LIMIT 0, 1", [":id" => $id])->toValue();
        return ($results? $results:null);

    }
}