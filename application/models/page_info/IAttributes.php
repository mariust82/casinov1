<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 3/1/2018
 * Time: 10:29 AM
 */

interface IAtributes
{
    public function getAttribute($attribute);

    public function setAttribute($attribute, $value);
}
