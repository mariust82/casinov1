<?php

require_once 'application/models/InvisionApi/src/InvisionApi.php';
require_once 'application/models/dao/InvisionDataModel.php';
require_once("application/models/dao/CasinoReviews.php");
require_once 'application/models/dao/ReviewStatuses.php';
require_once 'application/models/dao/InvisionReviewsModel.php';
require_once 'application/models/dao/InvisionCasinoModel.php';
require_once 'application/models/dao/ReviewsModel.php';

class CasinoReviewsModel{

    private $reviewData;
    private $invisionApi;
    private $blogId;
    private $invision_casino_id;
    private $reviewId;

    function __construct($app, $request)
    {
        $this->setInvisionApi($app);
        $reviewData = $request->parameters()->toArray();
        $reviewData['user_ip'] = $request->attributes()->get("ip");
        $reviewData['country'] = $request->attributes()->get("country")->id;
        $this->reviewData = $reviewData;
    }

    private function setInvisionApi($app){

        $env = $app->attributes()->get("environment");
        $configInvSettings = $app->getTag("invision_api")->$env;
        $apiKey =  (string)$configInvSettings['api_key'];
        $apiUrl = (string)$configInvSettings['api_url'];
        $this->blogId = (int)$configInvSettings['blog_id'];
        $this->invisionApi = new InvisionApi($apiKey, $apiUrl);
    }

    public function saveReview(){

        $invisionReviewsModel = new InvisionReviewsModel($this->invisionApi);

        if(empty($this->reviewData['invision_casino_id'])){

            $invisionCasinoModel = new InvisionCasinoModel($this->invisionApi);
            $this->invision_casino_id = $invisionCasinoModel->saveCasino( $this->reviewData['casino_id'] , $this->reviewData['casino'], $this->blogId);
        }else{

            $this->invision_casino_id = $this->reviewData['invision_casino_id'];
            $invisionReviewsModel->syncronizeWithInvision( $this->invision_casino_id ,$this->reviewData['casino_id'] );

        }


        $commentData = [
            'entry' => $this->invision_casino_id,
            'author' => 0,
            'content' => $this->reviewData['body'],
            'author_name' => $this->reviewData['name'],
            'date' => date('Y-m-d H:i:s'),
            'ip' => $this->reviewData['user_ip']
        ];
        $invisionComment =  $invisionReviewsModel->saveComment($commentData);

        $review_invision_id = '';
        $review_status =  ReviewStatuses::APPROVED;
        $review_url = '';

        if(!empty($invisionComment)){

            $review_invision_id = $invisionComment['id'];
            $review_status =  ReviewStatuses::APPROVED;
            $review_url =  $invisionComment['url'];
        }

        $this->reviewData['review_invision_id'] = $review_invision_id;
        $this->reviewData['review_status'] = $review_status;
        $this->reviewData['review_url'] = $review_url;

        $reviewsModel = new ReviewsModel($this->reviewData);
        $this->reviewId = $reviewsModel->saveComment();

    }

    public function getReviewId(){

        return $this->reviewId;

    }

    public function getReviewInvisionId(){

        return $this->invision_casino_id;
    }

}