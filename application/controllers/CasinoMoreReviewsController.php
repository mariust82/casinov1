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
class CasinoMoreReviewsController extends Lucinda\MVC\STDOUT\Controller
{
    public function run()
    {
        // get casino ID
        $object = new Casinos();
        $casinoID = $this->request->attributes('validation_results')->get('name');

        // get reviews
        $object = new CasinoReviews();
        $total_votes = $object->getAllVotes($casinoID);
        $type = $this->request->parameters("type");

        $casino_score = new CasinoScore();
        $votes = $this->getUserVotes($casinoID);

        if ($type == 'review') {
            $this->response->attributes("reviews", $object->getAll($casinoID, (integer) $this->request->getValidator()->parameters("page"), (integer) $this->request->parameters("id")));
        } else {
            $this->response->attributes("reviews", $object->getMoreReplies((integer) $this->request->getValidator()->parameters("page"), (integer) $this->request->parameters("id")));
        }
        $this->response->attributes("total_votes", $total_votes);
        $this->response->attributes("user_votes", $casino_score->setVotesByType($votes));
    }
}
