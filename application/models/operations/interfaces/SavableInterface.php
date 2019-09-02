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
    public function __construct($id);

    public function getPropertiesMap();

    public function setAttribute($name, $value);

    public function getAttribute($name);
}
