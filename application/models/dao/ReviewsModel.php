<?php
class ReviewsModel
{
    private $reviewData;

    public function __construct($reviewData)
    {
        $this->reviewData = $reviewData;
    }

    public function saveComment()
    {
        $review = new CasinoReview();
        $review->title = htmlspecialchars($this->reviewData['title']);
        $review->name = htmlspecialchars($this->reviewData['name']);
        $review->email = $this->reviewData['email'];
        $review->body = htmlspecialchars($this->reviewData['body']);
        $review->ip = $this->reviewData['user_ip'];
        $review->country = $this->reviewData['country'];// $this->request->attributes("country")->id;
        $review->parent = $this->reviewData["parent"];
        $review->status = $this->reviewData['review_status'];
        $object = new CasinoReviews();
        $id = $object->insert($this->reviewData['casino_id'], $review);

        return $id;
    }
}
