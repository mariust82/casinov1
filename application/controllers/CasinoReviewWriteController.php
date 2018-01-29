<?php
require_once("application/models/dao/CasinoReviews.php");
require_once("vendor/lucinda/nosql-data-access/src/exceptions/OperationFailedException.php");

/*
* Writes a review on a casino
* 
* @requestMethod POST
* @responseFormat JSON
* @source 
* @requestParameter casino string Name of casino
* @requestParameter name string Reviewer name
* @requestParameter email string Reviewer email
* @requestParameter body string Review body
* @requestParameter parent integer 0 or id of review replied to
*/
class CasinoReviewWriteController extends Controller {
	public function run() {
        $review = new CasinoReview();
        $review->name = strip_tags($_POST["name"]);
        $review->email = strip_tags($_POST["email"]);
        $review->body = strip_tags($_POST["body"]);
        $review->ip = ip2long($this->request->getAttribute("ip"));
        $review->country = $this->request->getAttribute("country")->id;
        $review->parent = (integer) $_POST["parent"];

        $object = new CasinoReviews();
        $id = $object->insert($_POST["casino"], $review);
        if($id) {
            $this->response->setAttribute("id", $id);
        } else {
            throw new OperationFailedException("Casino not found!");
        }
	}
}
