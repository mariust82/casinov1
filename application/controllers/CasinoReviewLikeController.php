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
class CasinoReviewLikeController extends Lucinda\MVC\STDOUT\Controller {
	public function run() {

        $object = new CasinoReviews();
        if(!$object->incrementLikes(
            $this->request->attributes()->get('validation_results')->get('id'),
            $this->request->attributes()->get("ip"))
        ) {
            throw new OperationFailedException("Review already liked!");
        }
	}
}
