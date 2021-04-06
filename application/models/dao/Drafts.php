<?php

use gtm\operations\DraftObject;

require_once 'application/models/operations/savable_objects/DraftObject.php';
require_once 'application/models/dao/entities/BlogPost.php';

/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 09-Jul-18
 * Time: 3:25 PM
 */
class Drafts
{
    public function getInfoByName($name)
    {
        $results = SQL("select *
                            from drafts
                            where entity_name like :name;", array(':name' => "%$name%"));

        // I should create a new DraftModelPopulator to populate the DraftObject, but for this test i will
        // manually populate the properties;

        return $this->populate($results);
    }

    public function getInfoById($id)
    {
        $results = SQL("select *
                            from drafts
                            where id = :id;", array(':id' => "$id"));
        return $this->populate($results);
    }

    /**
     * @param $results
     * @param $drafts
     * @return array
     */
    private function populate($results)
    {
        $drafts = array();
        while ($row = $results->toRow()) {
            $draftObject = new DraftObject(null);
            $draftObject->id = $row['id'];
            $draftObject->entity_id = $row['entity_id'];
            $draftObject->user_id = $row['user_id'];
            $draftObject->entity_name = $row['entity_name'];
            $draftObject->payload = unserialize($row['payload']);
            $draftObject->date_modified = $row['date_modified'];

            if (empty($row['id'])) {
                $stop = true;
            }

            // Add extra properties to the payload because the payload
            // is all i have to carry information into the js.
            $draftObject->payload->draftId = $row['id'];

            $drafts[] = $draftObject;
        }
        return $drafts;
    }
}
