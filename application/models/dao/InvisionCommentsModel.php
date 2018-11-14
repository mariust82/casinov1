<?php
require_once 'application/models/InvisionApi/src/InvisionComments.php';

class InvisionCommentsModel{

    public function getReviewsFromInvision($invision_casino_id){

        $invision = new InvisionComments();
        $endPoints = str_replace('{#id}', $invision_casino_id,  InvisionAppEndPoints::$endpoints['entries']['get_entry_comments']['url']);
        $endPoints .= '?'.http_build_query(['page'=>1,'perPage' => 250],null,'&');

        $invision->setEndpoint($endPoints);
        $comments = $invision->getAllCommentsFromCasino();
        $comments = json_decode($comments, true);
        return $comments;
    }

    public function groupInvsionCommentsById($comments){

        $invisionIds = [];
        foreach($comments as $comment){

            $invisionIds[$comment['id']] = $comment;
        }
        return $invisionIds;
    }
}