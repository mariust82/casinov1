<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 20-Apr-18
 * Time: 2:11 PM
 */

namespace gtm\operations;

interface OperationsInterface
{
    function execute();

    function addObject(SavableInterface $savableObject);

    function getObject();
}