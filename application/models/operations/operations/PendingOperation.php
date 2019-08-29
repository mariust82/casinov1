<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 25-Apr-18
 * Time: 12:24 PM
 */

require_once 'application/models/bonus_publisher/interfaces/OperationsInterface.php';

class PendingOperation implements OperationsInterface
{

    /**
     * @var SavableInterface
     */
    protected $savableObject;

    function execute()
    {
        if (!$this->savableObject) throw new Exception('Invalid savable object.');

        if ($this->savableObject->id) {
            // update
            $this->updatePendingObject($this->savableObject);
        } else {
            // insert
            $this->createNewPendingObject($this->savableObject);
        }
    }

    function addObject(SavableInterface $savableObject)
    {
        // TODO: Implement addObject() method.
        $this->savableObject = $savableObject;
    }

    private function createNewPendingObject(AbstractPendingSavableObject $savableObject)
    {
        $insertId = DB("
            INSERT INTO dashboard SET saver_user_id = :saver_user_id, current_user_id = :current_user_id, element_id = :element_id,
            panel_id = :panel_id, status_id = :status_id, payload = :payload, date_added = :date_added,
            date_completed = :date_completed, date_modified = :date_modified, draft_id = :draft_id",

            array(':saver_user_id' => $savableObject->saver_user_id, ':current_user_id' => $savableObject->current_user_id,
                ':element_id' => $savableObject->element_id, ':panel_id' => $savableObject->panel_id,
                ':status_id' => $savableObject->status_id, ':payload' => $savableObject->payload,
                ':date_added' => $savableObject->date_added, ':date_completed' => $savableObject->date_completed,
                ':date_modified' => $savableObject->date_modified, ':draft_id' => $savableObject->draft_id
            ))->getInsertId();

        return $insertId;
    }

    private function updatePendingObject(AbstractPendingSavableObject $savableObject)
    {
        $affectedRows = DB("
            UPDATE dashboard SET saver_user_id = :saver_user_id, current_user_id = :current_user_id, element_id = :element_id,
            panel_id = :panel_id, status_id = :status_id, payload = :payload, date_added = :date_added,
            date_completed = :date_completed, date_modified = :date_modified, draft_id = :draft_id WHERE id = :id",

            array(':id' => $savableObject->id, ':saver_user_id' => $savableObject->saver_user_id, ':current_user_id' => $savableObject->current_user_id,
                ':element_id' => $savableObject->element_id, ':panel_id' => $savableObject->panel_id,
                ':status_id' => $savableObject->status_id, ':payload' => $savableObject->payload,
                ':date_added' => $savableObject->date_added, ':date_completed' => $savableObject->date_completed,
                ':date_modified' => $savableObject->date_modified, ':draft_id' => $savableObject->draft_id
            ))->getInsertId();

        return $affectedRows;
    }
}