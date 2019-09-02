<?php

use gtm\operations\SavableInterface;

require_once 'application/models/operations/interfaces/SavableInterface.php';

/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 07-Jul-18
 * Time: 4:31 PM
 */
class BlogPost extends Entity implements SavableInterface
{
    public $id, $name, $readingTime, $content, $titleImageDesktop, $titleImageMobile, $thumbnail, $postDate, $routeId, $draftId;

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
        $this->$name = $value;
    }

    function getAttribute($name)
    {
        // TODO: Implement getAttribute() method.
        return $this->$name;
    }
}