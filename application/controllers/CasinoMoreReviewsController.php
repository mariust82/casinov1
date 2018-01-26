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
class CasinoMoreReviewsController extends Controller {
	public function run() {
	    // get casino ID
        $object = new Casinos();
        $casinoID = $object->getID(str_replace("-", " ", $this->request->getValidator()->getPathParameter("name")));
        if(!$casinoID) throw new PathNotFoundException();

        // get reviews
        $object = new CasinoReviews();
        $this->response->setAttribute("reviews", $object->getAll($casinoID, (integer) $this->request->getValidator()->getPathParameter("page"), (!empty($_GET["id"])?(integer) $_GET["id"]:0)));
	}
}
