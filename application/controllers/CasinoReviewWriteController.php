<?php

require_once("application/models/dao/CasinoReviews.php");
require_once("vendor/lucinda/nosql-data-access/src/exceptions/OperationFailedException.php");
require_once 'application/models/dao/Casinos.php';

require_once 'application/models/dao/InvisionCommentsModel.php';
require_once 'application/models/InvisionApi/src/InvisionApi.php';
require_once 'application/models/dao/ReviewStatuses.php';

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
        $casino_id  = $_POST["casino_id"];
        $invision_casino_id  = $_POST["invision_casino_id"];
        $casino_name =  $_POST["casino"];
        $content = strip_tags($_POST["body"]);
        $author_name = strip_tags($_POST["name"]);
        $author_email =  strip_tags($_POST["email"]);
        $user_ip =  $this->request->getAttribute("ip");


        $env = $this->application->getAttribute("environment");
        $invsionInstanceAPI= new InvisionApi(
            $this->application->getXML()->invision_api->$env->invision['api_key'],
            $this->application->getXML()->invision_api->$env->invision['api_url']
        );

        $invisionModel = new InvisionCommentsModel($invsionInstanceAPI);

        if(empty($invision_casino_id)){

            //add casino to invision
            $invisionCasino =  $invisionModel->addCasinoToInvision(
                $casino_name,
                $this->application->getXML()->invision_api->$env->invision['blog_id']
            );

            $invision_casino_id =  !empty($invisionCasino['id']) ? $invisionCasino['id'] : '';
            $casinoInfoModel = new Casinos();
            $casinoInfoModel->updateCasinoForEntries($casino_id,$invision_casino_id);
        }else{


            $invisionModel->syncronizeReviewsWithInvision($invision_casino_id, $casino_id);
        }

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

        $review_invision_id = '';
        $review_status =  ReviewStatuses::PENDING;
        $review_url = '';

        if(!empty($invisionComment)){

            $review_invision_id = $invisionComment['id'];
            $review_status =  !empty($invisionComment['hidden']) ? ReviewStatuses::APPROVED : ReviewStatuses::DENIED;
            $review_url =  $invisionComment['url'];
        }

        $review = new CasinoReview();
        $review->name = $author_name;
        $review->email = $author_email;
        $review->body = $content;
        $review->ip = $user_ip;
        $review->country = $this->request->getAttribute("country")->id;
        $review->parent = (integer)$_POST["parent"];
        $review->review_invision_id = $review_invision_id;
        $review->status = $review_status;
        $review->invision_url = $review_url;
        $object = new CasinoReviews();
        $id = $object->insert($casino_id, $review);

        if(empty($id)){
            throw new OperationFailedException("Casino not found!");
        }

        $this->response->setAttribute("id", $id);
        $this->response->setAttribute("review_invision_id", $review->review_invision_id);

    }

}
