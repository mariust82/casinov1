<?php
require_once 'application/models/InvisionApi/src/InvisionComments.php';

class InvisionCommentsModel{

    public function getReviewsFromInvision($invision_casino_id){

        $invision = new InvisionComments();
        $endPoints = str_replace('{#id}', $invision_casino_id,  InvisionAppEndPoints::$endpoints['entries']['get_entry_comments']['url']);
        $invision->setEndpoint($endPoints);
        $comments = $invision->getAllCommentsFromCasino();
        $comments = json_decode($comments, true);

        var_dump($comments);
        die();


    }
}