<?php
class ReviewsInvisionSync{

    private $newInvsionComments = [];
    private $updateComments = [];

    function __construct($invisionComments, $dbComments)
    {
        $this->setCommentsForUpdate($invisionComments, $dbComments);

    }

    public function getSyncsReviewsData(){
        return[
            'newCommentsFromInvision' => $this->newInvsionComments,
            'updateComments' => $this->updateComments
        ];
    }

    private function setCommentsForUpdate($invisionComments, $dbComments){

        // group reviews by invision id
        $reviewGrouppedById = [];

        foreach ($dbComments as $review){
            $reviewGrouppedById[$review['invision_review_id']] = $review;
        }

        foreach($invisionComments as $invisionComment){

            if(!empty($reviewGrouppedById[$invisionComment['id']])){

                $review = $reviewGrouppedById[$invisionComment['id']];

                if($invisionComment['hidden'] != $review['hidden']){
                    $this->updateComments[$review['id']] = $invisionComment;
                    continue;
                }

                if($invisionComment['content'] != $review['body']){
                    $this->updateComments[$review['id']] = $invisionComment;
                    continue;
                }

            }else{
                $this->newInvsionComments[]  = $invisionComment;
            }
        }
    }
}