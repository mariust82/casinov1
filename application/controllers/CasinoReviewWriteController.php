<?php

require_once("application/models/dao/CasinoReviews.php");
require_once("vendor/lucinda/nosql-data-access/src/exceptions/OperationFailedException.php");

require_once 'application/models/dao/Casinos.php';
require_once 'application/models/InvisionApi/src/InvisionComments.php';
require_once 'application/models/InvisionApi/src/InvisionCasinos.php';
require_once 'application/models/dao/InvisionCommentsModel.php';
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

        if(empty($invision_casino_id)){

            //add casino to invision
            $invision_casino_id =  $this->addCasinoToInvision($casino_name);
            $casinoInfoModel = new Casinos();
            $casinoInfoModel->updateCasinoForEntries($casino_id,$invision_casino_id);
        }else{
          //TBD
            $this->updateCasinoReviewsFromInvision($invision_casino_id);
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

        $invisionComent = $this->addCommentToInvision($commentData);

        $review = new CasinoReview();
        $review->name = $author_name;
        $review->email = $author_email;
        $review->body = $content;
        $review->ip = $user_ip;
        $review->country = $this->request->getAttribute("country")->id;
        $review->parent = (integer)$_POST["parent"];
        $review->review_invision_id = $invisionComent['id'];
        $review->hidden = $invisionComent['hidden'];
        $review->invision_url = $invisionComent['url'];
        $object = new CasinoReviews();
        $id = $object->insert($casino_id, $review);

        if ($id) {
            $this->response->setAttribute("id", $id);
            $this->response->setAttribute("review_invision_id", $review->review_invision_id);
        } else {
            throw new OperationFailedException("Casino not found!");
        }
    }

     private function addCasinoToInvision($casino_name){

         $entry = [
             'blog' =>1, // add to
             'title' => $casino_name,
             // 'author' => 'hliscorp',
             'entry' => $casino_name
         ];

         $inv = new InvisionCasinos();
         $inv->setEndpoint(InvisionAppEndPoints::$endpoints['entries']['add_entry']['url']);
         $result = $inv->addCasinos($entry);
         $result = json_decode($result, true);
         $invision_casino_id = $result['id'];
         return $invision_casino_id;
     }


    private function addCommentToInvision($commentData){
        $invision = new InvisionComments();
        $invision->setEndpoint(InvisionAppEndPoints::$endpoints['entries']['comments']['add_comment']['url']);
        $invisionComent = $invision->addComment($commentData);
        return  json_decode($invisionComent, true);;
    }

    private function updateCasinoReviewsFromInvision($invision_casino_id){

        $invisionReviews =  new InvisionCommentsModel();
        $invision_comments =  $invisionReviews->getReviewsFromInvision($invision_casino_id);

        if(empty($invision_comments['results']))
            return;

        $invisionIds = [];
        foreach($invision_comments['results'] as $comment){

            $invisionIds[$comment['id']] = $comment;
        }

        //get all reviews
        $casinoReviewsOPbj = new CasinoReviews();
        $casinoReviewsOPbj->updateCommentsFromInviosn($invisionIds);
    }
}
