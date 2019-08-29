<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 25-Apr-18
 * Time: 12:35 PM
 */

namespace gtm\operations;

require_once 'application/models/operations/populators/DraftPopulator.php';
require_once 'application/models/operations/savable_objects/DraftObject.php';
require_once 'application/models/dao/entities/BlogPost.php';

use function get_class;
use function serialize;

class SavableObjectFactory
{

    /**
     * @var Request
     */
    private $request;

    function __construct(\Lucinda\MVC\STDOUT\Request $request)
    {
        $this->request = $request;
    }

    public function create($type, $payload)
    {
        $savableObject = null;

        switch ($type) {
            case 'draft':
                require_once 'application/models/operations/savable_objects/DraftObject.php';
                $savableObject = $this->getDraftObject($payload);
                break;
            case 'pending':
                require_once 'application/models/operations/savable_objects/PendingObject.php';
                require_once 'application/models/operations/populators/PendingPopulator.php';
                $savableObject = new PendingObject($this->request->parameters('id'));
                $pendingPopulator = new PendingPopulator($this->request);
                $pendingPopulator->populate($savableObject);
                break;
            case 'publish':
                // I think we can operate the draft object to publish it.
                $savableObject = $this->getDraftObject($payload);
                break;
            case 'tms':
                $savableObject = $this->getDraftObject($payload);
                break;
        }

        return $savableObject;
    }

    /**
     * @param $payload
     * @return DraftObject
     * @throws \Exception
     */
    private function getDraftObject($payload)
    {
        $savableObject = new DraftObject($this->request->parameters('draft_id'));
        $draftPopulator = new DraftPopulator($this->request);

        // Set data for the DraftObject
        $draftPopulator->populate($savableObject);

        // Set the data for the Payload.
        $payloadPopulatorFactory = new PayloadPopulatorFactory();
        $payloadPopulator = $payloadPopulatorFactory->create(get_class($payload), $this->request);
        $payloadPopulator->populate($payload);
        $savableObject->attributes('payload', $payload);
        return $savableObject;
    }
}