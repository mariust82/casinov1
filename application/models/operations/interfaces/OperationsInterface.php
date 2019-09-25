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
    public function execute();

    public function addObject(SavableInterface $savableObject);

    public function getObject();
}
