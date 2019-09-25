<?php
require_once("application/models/dao/CasinoReviews.php");
require_once 'application/models/dao/ReviewStatuses.php';
require_once 'application/models/dao/ReviewsModel.php';

class CasinoReviewsModel
{
    private $reviewData;
    private $reviewId;

    public function __construct($request)
    {
        $reviewData = $request->parameters();
        $reviewData['user_ip'] = $request->attributes("ip");
        $reviewData['country'] = $request->attributes("country")->id;
        $this->reviewData = $reviewData;
    }

    public function saveReview()
    {
        $review_status =  ReviewStatuses::APPROVED;
        $review_url = '';

        $this->reviewData['review_status'] = $review_status;
        $this->reviewData['review_url'] = $review_url;

        $reviewsModel = new ReviewsModel($this->reviewData);
        $this->reviewId = $reviewsModel->saveComment();
    }

    public function getReviewId()
    {
        return $this->reviewId;
    }
}
