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
        $reviewModelObj = new CasinoReviewsModel($this->application, $reviewData);
        $reviewModelObj->saveReview();
        $this->response->setAttribute("id", $reviewModelObj->getReviewId());
        $this->response->setAttribute("review_invision_id", $reviewModelObj->getReviewInvisionId());

//        $casino_id  = $_POST["casino_id"];
//        $invision_casino_id  = $_POST["invision_casino_id"];
//        $casino_name =  $_POST["casino"];
//        $content = strip_tags($_POST["body"]);
//        $author_name = strip_tags($_POST["name"]);
//        $author_email =  strip_tags($_POST["email"]);
//        $user_ip =  $this->request->getAttribute("ip");
//
//        $env = $this->application->getAttribute("environment");
//        $configInvSettings = $this->application->getXML()->invision_api->$env;
//        if(empty($configInvSettings)){
//            throw new Exception('Invision settings is not set in config');
//        }
//
//        $blogId = (int)$configInvSettings['blog_id'];
//        $apiKey =  (string)$configInvSettings['api_key'];
//        $apiUrl = (string)$configInvSettings['api_url'];
//
//        $invsionInstanceAPI= new InvisionApi($apiKey, $apiUrl);
//        $invisionModel = new InvisionCommentsModel($invsionInstanceAPI);
//
//        if(empty($invision_casino_id)){
//
//            $invision_casino_id =  $this->saveCasinoCasinoInInvision($invisionModel, $blogId, $casino_id,  $casino_name);
//            $this->updateCasinoForInvision($casino_id, $invision_casino_id);
//
//        }else{
//
//            $this->syncronizeReviewsWithInvision($invisionModel, $invision_casino_id, $casino_id);
//        }
//
//
//        $invisionComment = $this->saveCommentToInvision($invsionInstanceAPI, $invision_casino_id, $content, $author_name, $user_ip);
//
//        $review_invision_id = '';
//        $review_status =  ReviewStatuses::PENDING;
//        $review_url = '';
//
//        if(!empty($invisionComment)){
//
//            $review_invision_id = $invisionComment['id'];
//            $review_status =  !empty($invisionComment['hidden']) ? ReviewStatuses::APPROVED : ReviewStatuses::DENIED;
//            $review_url =  $invisionComment['url'];
//        }
//
//        $review = new CasinoReview();
//        $review->name = $author_name;
//        $review->email = $author_email;
//        $review->body = $content;
//        $review->ip = $user_ip;
//        $review->country = $this->request->getAttribute("country")->id;
//        $review->parent = (integer)$_POST["parent"];
//        $review->review_invision_id = $review_invision_id;
//        $review->status = $review_status;
//        $review->invision_url = $review_url;
//        $object = new CasinoReviews();
//        $id = $object->insert($casino_id, $review);
//
//        if(empty($id)){
//            throw new OperationFailedException("Casino not found!");
//        }
        //$reviewModel = new ReviewModel($this->request->getParameters());
       // $this->response->setAttribute("id", $id);
       // $this->response->setAttribute("review_invision_id", $review->review_invision_id);

    }


    /*private function syncronizeReviewsWithInvision($invisionModel, $invision_casino_id, $casino_id){

        $invisionModel->syncronizeReviewsWithInvision($invision_casino_id, $casino_id);
    }

    private function saveCasinoCasinoInInvision($invisionModel, $casino_name, $blogId){

        $invisionCasino =  $invisionModel->addCasinoToInvision($casino_name, $blogId);

        return $invision_casino_id;
    }


    private function updateCasinoForInvision($casino_id, $invision_casino_id, $content){

        $casinoInfoModel = new Casinos();
        $casinoInfoModel->updateCasinoForEntries($casino_id,$invision_casino_id);
    }



    //................
    private function saveCommentToInvision($invsionInstanceAPI, $invision_casino_id, $content, $author_name, $user_ip){

        $invisionModel = new InvisionCommentsModel($invsionInstanceAPI);

        //set review to set in invision
        $commentData = [
            'entry' => $invision_casino_id,
            'author' => 0,
            'content' => $content,
            'author_name' => $author_name,
            'date' => date('Y-m-d H:i:s'),
            'ip' => $user_ip
        ];

        $invisionComment = $invisionModel->addCommentToInvision($commentData);
        return $invisionComment;
    }


    private function saveComment(){

    }*/
}

