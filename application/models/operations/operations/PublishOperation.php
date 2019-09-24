<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 20-Apr-18
 * Time: 5:11 PM
 */

namespace gtm\operations;

require_once 'application/models/operations/interfaces/OperationsInterface.php';
require_once 'application/models/operations/operations/TmsOperation.php';

class PublishOperation implements OperationsInterface
{
    /**
     * @var SavableInterface
     */
    protected $savableObject;

    public function __construct()
    {
    }

    public function execute()
    {
        $id = null;

        if (!$this->savableObject) {
            throw new Exception('Invalid savable object.');
        }

        if ($this->savableObject->payload->id) {
            // update
            $this->update($this->savableObject);
            $id = $this->savableObject->payload->id;
        } else {
            // insert
            $id = $this->publish($this->savableObject);
        }

        // Insert into tms_content
        $this->savableObject->payload->id = $id;
        $tmsOperation = new TmsOperation();
        $tmsOperation->addObject($this->savableObject);
        $tmsOperation->execute();

        return $id;
    }

    public function addObject(SavableInterface $savableObject)
    {
        $this->savableObject = $savableObject;
    }

    private function createNewPendingDashboard(AbstractPendingSavableObject $savableObject)
    {
        $insertId = DB(
            "
          INSERT INTO drafts SET saver_user_id = :saver_user_id",
            array(':saver_user_id' => $savableObject->user_id)
        )->getInsertId();
        return $insertId;
    }

    public function getObject()
    {
        // TODO: Implement getObject() method.
    }

    private function publish(SavableInterface $savableObject)
    {
        $payload = $savableObject->payload;

        $insertId = DB(
            "
            INSERT INTO blog_posts SET title = :title, reading_time = :reading_time, content = :content,
            title_image_desktop = :title_image_desktop, title_image_mobile = :title_image_mobile,
            thumbnail_image = :thumbnail_image, post_date = :post_date, route_id = :route_id",
            array(
                ':title' => $payload->name, ':reading_time' => $payload->readingTime,
                ':content' => $payload->content, ':title_image_desktop' => $payload->titleImageDesktop,
                ':title_image_mobile' => $payload->titleImageMobile, ':thumbnail_image' => $payload->thumbnail,
                ':post_date' => $payload->postDate, ':route_id' => $payload->route_id
            )
        )->getInsertId();

        return $insertId;
    }

    private function update($savableObject)
    {
        $payload = $savableObject->payload;

        $affectedRows = DB(
            "
            UPDATE blog_posts SET title = :title, reading_time = :reading_time, content = :content,
            title_image_desktop = :title_image_desktop, title_image_mobile = :title_image_mobile,
            thumbnail_image = :thumbnail_image, post_date = :post_date, route_id = :route_id WHERE id = :id",
            array(
                ':title' => $payload->name, ':reading_time' => $payload->readingTime,
                ':content' => $payload->content, ':title_image_desktop' => $payload->titleImageDesktop,
                ':title_image_mobile' => $payload->titleImageMobile, ':thumbnail_image' => $payload->thumbnail,
                ':post_date' => $payload->postDate, ':route_id' => $payload->route_id, ':id' => $payload->id
            )
        )->getInsertId();
    }
}
