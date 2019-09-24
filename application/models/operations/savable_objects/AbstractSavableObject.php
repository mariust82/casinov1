<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 20-Apr-18
 * Time: 2:56 PM
 */

namespace gtm\operations;

abstract class AbstractSavableObject
{
    // Those properties are mapping the drafts table.
    public $id;
    public $user_id;
    public $panel_id;
    public $entity_id;
    public $entity_name;
    public $payload;
    public $date_modified;
}
