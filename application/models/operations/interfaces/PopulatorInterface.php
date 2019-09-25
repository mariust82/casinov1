<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 20-Apr-18
 * Time: 3:41 PM
 */

namespace gtm\operations;

require_once 'application/models/operations/interfaces/SavableInterface.php';

interface PopulatorInterface
{
    public function populate(SavableInterface &$savableObject);

    public function __construct(\Lucinda\MVC\STDOUT\Request $request);
}
