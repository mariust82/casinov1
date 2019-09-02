<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 20-Apr-18
 * Time: 2:17 PM
 */

namespace gtm\operations;

interface SavableInterface
{
    function __construct($id);

    function getPropertiesMap();

    function setAttribute($name, $value);

    function getAttribute($name);
}