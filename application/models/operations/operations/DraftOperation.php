<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 20-Apr-18
 * Time: 2:14 PM
 */

namespace gtm\operations;

use function serialize;

require_once 'application/models/operations/interfaces/OperationsInterface.php';

class DraftOperation implements OperationsInterface
{

    /**
     * @var SavableInterface
     */
    protected $savableObject;

    public function execute()
    {
        if (!$this->savableObject) {
            throw new Exception('Invalid savable object.');
        }

        if ($this->savableObject->id) {
            // existing, update
            $affectedRows = $this->updateDraft($this->savableObject);
            $insertId = $this->savableObject->id;
        } else {
            // new, insert
            $insertId = $this->createNewDraft($this->savableObject);
        }

        return $insertId;
    }

    public function addObject(SavableInterface $savableObject)
    {
        $this->savableObject = $savableObject;
    }

    private function createNewDraft(AbstractSavableObject $savableObject)
    {
        return DB(
            "
            INSERT INTO drafts set user_id = :user_id, panel_id = :panel_id, entity_id = :entity_id, 
            entity_name = :entity_name, payload = :payload, date_modified = :date_modified",
            array(':user_id' => $savableObject->user_id, ':panel_id' => $savableObject->panel_id,
                ':entity_id' => $savableObject->entity_id, ':entity_name' => $savableObject->entity_name,
                ':payload' => serialize($savableObject->payload), ':date_modified' => date('Y-m-d H:i:s'))
        )->getInsertId();
    }

    private function updateDraft(AbstractSavableObject $savableObject)
    {
        return DB(
            "
            UPDATE drafts set user_id = :user_id, panel_id = :panel_id, entity_id = :entity_id, 
            entity_name = :entity_name, payload = :payload, date_modified = :date_modified
            WHERE id = :id",
            array(':user_id' => $savableObject->user_id, ':panel_id' => $savableObject->panel_id,
                ':entity_id' => $savableObject->entity_id, ':entity_name' => $savableObject->entity_name,
                ':payload' => serialize($savableObject->payload), ':date_modified' => $savableObject->date_modified,
                ':id' => $savableObject->id)
        )->getAffectedRows();
    }

    public function getObject()
    {
        return $this->savableObject;
    }
}
