<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 07-Jul-18
 * Time: 4:51 PM
 */

namespace gtm\operations;

use Exception;
use function file_exists;
use Request;

class PayloadPopulatorFactory
{
    /**
     * @param $type
     * @return PopulatorInterface
     * @throws Exception
     */
    public function create($type, Lucinda\MVC\STDOUT\Request $request)
    {
        $requiredFile = "application/models/operations/populators/$type" . "Populator.php";
        $namespace = "gtm\\operations\\";
        $class = $namespace . $type . "Populator";

        if (file_exists($requiredFile)) {
            require_once $requiredFile;
            return new $class($request);
        } else {
            throw new Exception('PayloadPopulator not found');
        }
    }
}
