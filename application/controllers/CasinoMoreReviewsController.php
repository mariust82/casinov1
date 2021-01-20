<?php
require_once("application/models/dao/CasinoReviews.php");
require_once("application/models/dao/Casinos.php");
require_once("application/models/CasinoScore.php");
require_once("application/models/dao/CasinoInfo.php");
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
        $total = $object->getAllTotal($casinoID);
        $casino_score = new CasinoScore();
        $votes = $object->getUserVotes($casinoID);

        if ($type == 'review') {
            $this->response->attributes("reviews", $object->getAll($casinoID, (integer) $this->request->getValidator()->parameters("page"), (integer) $this->request->parameters("id")));
        } else {
            $this->response->attributes("reviews", $object->getMoreReplies((integer) $this->request->getValidator()->parameters("page"), (integer) $this->request->parameters("id")));
        }
        $object = new CasinoInfo($this->request->attributes('validation_results')->get('name'), $this->request->attributes("country")->id);
        $info = $object->getResult();
        $this->response->attributes("casino", (array) $info);
        $this->response->attributes("total_reviews", $total);
        $this->response->attributes("total_votes", $total_votes);
        $this->response->attributes("user_votes", $casino_score->setVotesByType($votes));
    }
}
