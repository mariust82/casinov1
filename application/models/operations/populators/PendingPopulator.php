<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 25-Apr-18
 * Time: 12:45 PM
 */

require_once 'application/models/dao/Dashboard.php';

class PendingPopulator implements PopulatorInterface
{

    /**
     * @var Request
     */
    private $request;

    function populate(SavableInterface &$savableObject)
    {
        $savableObject->attributes('id', $this->request->parameters('id'));
        $savableObject->attributes('saver_user_id', $this->request->parameters('user_id'));
        $savableObject->attributes('current_user_id', $this->request->parameters('user_id'));
        $savableObject->attributes('element_id', $this->request->parameters('entity_id'));
        $savableObject->attributes('panel_id', $this->request->parameters('panel_id'));
        $savableObject->attributes('status_id', Drafts::STATUS_PENDING);
        $savableObject->attributes('payload', $this->request->parameters('payload'));
        $savableObject->attributes('date_added', date('Y-m-d H:i:s'));
        $savableObject->attributes('date_completed', date('Y-m-d H:i:s'));
        $savableObject->attributes('date_modified', date('Y-m-d H:i:s'));
        $savableObject->attributes('draft_id', $this->request->parameters('draft_id'));
    }

    public function __construct(Lucinda\MVC\STDOUT\Request $request)
    {
        $this->request = $request;
    }
}