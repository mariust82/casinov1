<?php

class InvisionReviewsModel{

    private $invisionApi;
    public function __construct(InvisionApi $invisionApi)
    {
        $this->invisionApi = $invisionApi;
    }

    public function saveComment($commentData){

        $invisionModel = new InvisionDataModel($this->invisionApi);
        $invisionComment = $invisionModel->addCommentToInvision($commentData);
        return $invisionComment;

    }

    public function syncronizeWithInvision($invision_casino_id, $casino_id){
        $invisionModel = new InvisionDataModel($this->invisionApi);
        $invisionModel->syncronizeReviewsWithInvision($invision_casino_id, $casino_id);
    }

}