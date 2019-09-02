<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 20-Apr-18
 * Time: 3:42 PM
 */

namespace gtm\operations;

require_once 'application/models/operations/interfaces/PopulatorInterface.php';
require_once 'application/models/dao/entities/BlogPost.php';
require_once 'application/models/operations/factories/PayloadPopulatorFactory.php';

class DraftPopulator implements PopulatorInterface
{

    /**
     * @var Request
     */
    protected $request;
    /**
     * @var PayloadPopulatorFactory
     */
    private $payloadPopulatorFactory;

    public function populate(SavableInterface &$savableObject)
    {
        // TODO: continue to add the attributes you know this object has.
        $savableObject->attributes('id', $this->request->parameters('draft_id'));
        $savableObject->attributes('user_id', $this->request->attributes('user_id'));
        $savableObject->attributes('panel_id', 75);
        $savableObject->attributes('entity_id', $this->request->attributes('entity_id') | 0);
        $savableObject->attributes('entity_name', $this->request->parameters('search'));
        $savableObject->attributes('date_modified', date('Y-m-d H:i:s'));
    }

    public function __construct(\Lucinda\MVC\STDOUT\Request $request)
    {
        $this->request = $request;
        $this->payloadPopulatorFactory = new PayloadPopulatorFactory();
    }
}
