<?php

require_once("application/models/dao/CasinoReviews.php");
require_once("vendor/lucinda/nosql-data-access/src/exceptions/OperationFailedException.php");
require_once 'application/models/dao/Casinos.php';
require_once 'application/models/dao/CasinoReviewsModel.php';

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
class CasinoReviewWriteController extends Lucinda\MVC\STDOUT\Controller
{
    public function run()
    {
        $reviewModelObj = new CasinoReviewsModel($this->application, $this->request);
        $reviewModelObj->saveReview();
        $this->response->attributes("id", $reviewModelObj->getReviewId());
        $this->response->attributes("review_invision_id", $reviewModelObj->getReviewInvisionId());
    }
}

