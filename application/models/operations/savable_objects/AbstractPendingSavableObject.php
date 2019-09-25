<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 25-Apr-18
 * Time: 12:10 PM
 */

class AbstractPendingSavableObject implements SavableInterface
{
    public $id;
    public $saver_user_id;
    public $current_user_id;
    public $element_id;
    public $panel_id;
    public $status_id;
    public $payload;
    public $date_added;
    public $date_completed;
    public $date_modified;
    public $draft_id;

    public function setAttribute($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    public function getAttribute($name)
    {
        // TODO: Implement getAttribute() method.
    }

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getPropertiesMap()
    {
        // TODO: Implement getPropertiesMap() method.
    }
}
