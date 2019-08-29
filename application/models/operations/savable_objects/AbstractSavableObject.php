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
    public $id, $user_id, $panel_id, $entity_id, $entity_name, $payload, $date_modified;
}