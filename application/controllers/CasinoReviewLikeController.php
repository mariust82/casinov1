<?php
require_once("application/models/dao/CasinoReviews.php");
require_once("vendor/lucinda/nosql-data-access/src/exceptions/OperationFailedException.php");

/*
* Increments like on a casino review.
* 
* @requestMethod POST
* @responseFormat JSON
* @source 
* @requestParameter id integer ID of liked review
*/
class CasinoReviewLikeController extends Controller {
	public function run() {
        $object = new CasinoReviews();
        if(!$object->incrementLikes($_POST["id"], $this->request->getAttribute("ip"))) {
            throw new OperationFailedException("Review already liked!");
        }
	}
}
