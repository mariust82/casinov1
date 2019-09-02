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
    public $id;
    public $name;
    public $readingTime;
    public $content;
    public $titleImageDesktop;
    public $titleImageMobile;
    public $thumbnail;
    public $postDate;
    public $routeId;
    public $draftId;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getPropertiesMap()
    {
        // TODO: Implement getPropertiesMap() method.
    }

    public function setAttribute($name, $value)
    {
        $this->$name = $value;
    }

    public function getAttribute($name)
    {
        // TODO: Implement getAttribute() method.
        return $this->$name;
    }
}
