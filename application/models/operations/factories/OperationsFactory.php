<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 07-Jul-18
 * Time: 3:46 PM
 */

namespace gtm\operations;

class OperationsFactory
{
    public function create($operationType)
    {
        $operation = null;

        switch ($operationType) {
            case 'draft':
                require_once 'application/models/operations/operations/DraftOperation.php';
                $operation = new DraftOperation();
                break;
            case 'publish':
                require_once 'application/models/operations/operations/PublishOperation.php';
                $operation = new PublishOperation();
                break;
            case 'pending':
                require_once 'application/models/operations/operations/PendingOperation.php';
                $operation = new PendingOperation();
                break;
            case 'tms':
                require_once 'application/models/operations/operations/TmsOperation.php';
                $operation = new TmsOperation();
                break;
        }
        return $operation;
    }
}
