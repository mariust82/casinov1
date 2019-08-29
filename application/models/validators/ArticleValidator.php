<?php
/**
 * Created by PhpStorm.
 * User: Alexandru.D
 * Date: 12/20/2018
 * Time: 4:52 PM
 */

class ArticleValidator extends Lucinda\RequestValidator\ParameterValidator{

    public function validate($value) {

        $results = SQL("SELECT id FROM `articles` WHERE articles.`title`=:name LIMIT 1", [':name' => str_replace('-', ' ', $value)])->toValue();

        return ($results? $results:null);

    }

}