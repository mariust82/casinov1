<?php
class ReviewsModel{

    private $reviewData;

    public function __construct($reviewData)
    {
        $this->reviewData = $reviewData;
    }

    public function saveComment(){

        $review = new CasinoReview();
        $review->name = $this->reviewData['name'];
        $review->email = $this->reviewData['email'];
        $review->body = $this->reviewData['body'];
        $review->ip = $this->reviewData['user_ip'];
        $review->country = $this->reviewData['country'];// $this->request->getAttribute("country")->id;
        $review->parent = $this->reviewData["parent"];
        $review->review_invision_id = $this->reviewData['review_invision_id'];
        $review->status = $this->reviewData['review_status'];
        $review->invision_url = $this->reviewData['review_url'];
        $object = new CasinoReviews();
        $id = $object->insert($this->reviewData['casino_id'], $review);

        return $id;

    }
}