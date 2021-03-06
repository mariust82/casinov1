<?php
require_once("application/models/dao/CasinoReviews.php");
require_once("application/models/UserOperationFailedException.php");

/*
* Increments like on a casino review.
*
* @requestMethod POST
* @responseFormat JSON
* @source
* @requestParameter id integer ID of liked review
*/
class CasinoReviewLikeController extends Lucinda\MVC\STDOUT\Controller
{
    public function run()
    {
        $object = new CasinoReviews();
        if (!$object->incrementLikes(
            $this->request->attributes('validation_results')->get('id'),
            $this->request->attributes("ip")
        )
        ) {
            $this->response->attributes("status", "not_ok");
            $this->response->attributes("message","Review already liked!");
           // throw new UserOperationFailedException("Review already liked!");
        }
    }
}
