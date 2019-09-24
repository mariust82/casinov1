<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 20-Apr-18
 * Time: 2:11 PM
 */


use gtm\operations\OperationsInterface;

class OperationsManager
{

    /**
     * @var OperationsInterface
     */
    protected $operation;

    public function setOperation(OperationsInterface $operation)
    {
        $this->operation = $operation;
    }

    public function execute()
    {
        return $this->operation->execute();
    }
}
