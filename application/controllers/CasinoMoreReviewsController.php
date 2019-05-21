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
        $casinoID = $this->request->attributes()->get('validation_results')->get('name');

        // get reviews
        $object = new CasinoReviews();
        $this->response->attributes()->set("reviews", $object->getAll($casinoID, (integer) $this->request->getValidator()->getPathParameter("page"), (integer) $this->request->attributes()->get("id")));
	}
}
