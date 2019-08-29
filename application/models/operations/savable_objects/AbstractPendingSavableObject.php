<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 25-Apr-18
 * Time: 12:10 PM
 */

class AbstractPendingSavableObject implements SavableInterface
{
    public $id, $saver_user_id, $current_user_id, $element_id, $panel_id,
        $status_id, $payload, $date_added, $date_completed,
        $date_modified, $draft_id;

    function setAttribute($name, $value)
    {
        if (property_exists($this, $name)) $this->$name = $value;
    }

    function getAttribute($name)
    {
        // TODO: Implement getAttribute() method.
    }

    public function __construct($id)
    {
        $this->id = $id;
    }

    function getPropertiesMap()
    {
        // TODO: Implement getPropertiesMap() method.
    }
}