<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 25-Apr-18
 * Time: 11:11 AM
 */

require_once 'application/models/bonus_publisher/savable_objects/AbstractPendingSavableObject.php';

class PendingObject extends AbstractPendingSavableObject
{
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getPropertiesMap()
    {
        // TODO: Implement getPropertiesMap() method.
    }
}
