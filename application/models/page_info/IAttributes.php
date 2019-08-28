<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 3/1/2018
 * Time: 10:29 AM
 */

interface IAtributes
{
    function getAttribute($attribute);

    function setAttribute($attribute, $value);
}