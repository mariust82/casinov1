<?php
require_once("application/models/dao/CasinoReviews.php");
require_once("application/models/dao/Casinos.php");

/*
* Gets more reviews/replies on a casino.
* 
* @requestMethod GET
* @responseFormat HTML
* @source 
* @pathParameter name string Name of casino
* @pathParameter page integer Results page for reviews
* @requestParameter id integer 0 or ID or review replied to (when show more replies)
*/
class CasinoMoreReviewsController extends Lucinda\MVC\STDOUT\Controller {
	public function run() {
	    // get casino ID
        $object = new Casinos();
        $casinoID = $this->request->attributes('validation_results')->get('name');

        // get reviews
        $object = new CasinoReviews();
        $this->response->attributes("reviews", $object->getAll($casinoID, (integer) $this->request->getValidator()->parameters("page"), (integer) $this->request->attributes("id")));
	}
}
