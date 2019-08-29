<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 20-Apr-18
 * Time: 2:16 PM
 */

namespace gtm\operations;

require_once 'application/models/operations/interfaces/SavableInterface.php';
require_once 'application/models/operations/savable_objects/AbstractSavableObject.php';


class DraftObject extends AbstractSavableObject implements SavableInterface
{

    // Map between post->properties
    protected $propertiesMap = ['id' => 'id'];

    public function __construct($id)
    {
        $this->id = $id;
    }

    function getPropertiesMap()
    {
        // TODO: Implement getPropertiesMap() method.
    }

    function setAttribute($name, $value)
    {
        if (property_exists($this, $name)) $this->$name = $value;
    }

    function getAttribute($name)
    {
        if (!property_exists($this, $name)) return null;
        return $this->$name;
    }
}