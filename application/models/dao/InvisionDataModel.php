<?php
require_once 'application/models/InvisionApi/src/InvisionApi.php';
require_once 'application/models/ReviewsInvisionSync.php';

class InvisionDataModel{

    private $invisionApi;

   function __construct( InvisionApi $invisionApi)
   {
       $this->invisionApi = $invisionApi;
   }

    public function syncronizeReviewsWithInvision($invision_casino_id, $casino_id){

        $invisionReviews =  $this->invisionApi->getCasinoReviewsFromInvision($invision_casino_id);

        if(empty($invisionReviews['results']))
            return;

        $invisionIds = $this->groupInvsionCommentsById($invisionReviews['results']);
        $this->updateCommentsFromInvision($invisionIds, $casino_id);

    }


    private function groupInvsionCommentsById($comments){

        $invisionIds = [];
        foreach($comments as $comment){

            $invisionIds[$comment['id']] = $comment;
        }
        return $invisionIds;
    }

    private function updateCommentsFromInvision($invisionComments, $casino_id){

        //get invsion reviews from our database
        $reviews = $this->getAllReviewsByInvisionIds($invisionComments);
        $syncInv = new ReviewsInvisionSync($invisionComments, $reviews);

        $syncData = $syncInv->getSyncsReviewsData();

        if(!empty($syncData['newCommentsFromInvision'])){

            //add new comments
            foreach ($syncData['newCommentsFromInvision'] as $comment){
                $review = new CasinoReview();
                $review->name = $comment['author']['name'];
                $review->email = !empty($comment['author']['email']) ? $comment['author']['email'] : 'accounts@hliscorp.com';
                $review->body = $comment['content'];
                 $review->ip = $comment['author']['registrationIpAddress'];
                $review->country = 34;
                $review->parent = 0;
                $review->review_invision_id = $comment['id'];
                $review->status = !empty($comment['status']) ? ReviewStatuses::APPROVED : ReviewStatuses::DENIED;
                $review->invision_url = $comment['url'];
                $object = new CasinoReviews();
                $id = $object->insert($casino_id, $review);
            }
        }

        if(!empty($syncData['updateComments'])){
         
            //update comments
            foreach($syncData['updateComments'] as $id => $comment){
                DB ("
                  UPDATE casinos__reviews SET
                  body = :body,
                  status = :status
                  WHERE id = :id",
                    array(
                        ':body' => $comment['content'],
                        ':status' => empty($comment['hidden']) ? ReviewStatuses::APPROVED : ReviewStatuses::DENIED,
                        ':id' => $id
                    )
                );
            }
        }
    }

    public function addCasinoToInvision($casino_name, $blogId){

        $casinoData = [
            'blog' =>$blogId, // add to
            'author' => 0,
            'title' => $casino_name,
            'entry' => $casino_name
        ];

        $result = $this->invisionApi->addCasinosToInvision($casinoData);

        return $result;
    }

    public function addCommentToInvision($commentData){
        $result = $this->invisionApi->addReviewsToInvision($commentData);
        return $result;
    }

    private function getAllReviewsByInvisionIds(array $invisionCommentsIds = []){

        if(empty($invisionCommentsIds)){
            return;
        }

        $idsSqlFormat = implode(', ', array_keys($invisionCommentsIds));

        $q = " SELECT *
                FROM casinos__reviews 
                WHERE invision_review_id IN ($idsSqlFormat)
              ";

        return DB($q)->toList();
    }
}