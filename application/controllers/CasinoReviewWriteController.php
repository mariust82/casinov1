<?php

require_once("application/models/dao/CasinoReviews.php");
require_once("vendor/lucinda/nosql-data-access/src/exceptions/OperationFailedException.php");
require_once 'application/models/dao/Casinos.php';

require_once 'application/models/dao/InvisionDataModel.php';
require_once 'application/models/InvisionApi/src/InvisionApi.php';
require_once 'application/models/dao/ReviewStatuses.php';
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
class CasinoReviewWriteController extends Controller
{

    public function run()
    {
        $reviewData = $this->request->getParameters();
        $reviewData['user_ip'] = $this->request->getAttribute("ip");
        $reviewData['country'] = $this->request->getAttribute("country")->id;
        // $reviewData
        $reviewModelObj = new CasinoReviewsModel($this->application, $this->request);
        $reviewModelObj->saveReview();
        $this->response->setAttribute("id", $reviewModelObj->getReviewId());
        $this->response->setAttribute("review_invision_id", $reviewModelObj->getReviewInvisionId());
    }
}

