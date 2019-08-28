<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 3/1/2018
 * Time: 10:32 AM
 */

require_once 'application/models/page_info/IAttributes.php';

class Body implements IAtributes
{

    protected $attributes = [];

    function getAttribute($attribute)
    {
        return empty($this->attributes[$attribute]) ? "" : $this->attributes[$attribute];
    }

    function setAttribute($attribute, $value)
    {
        $this->attributes[$attribute] = $value;
    }
}