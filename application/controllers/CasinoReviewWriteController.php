<?php

require_once("application/models/dao/CasinoReviews.php");
require_once("vendor/lucinda/nosql-data-access/src/exceptions/OperationFailedException.php");

require_once 'application/models/InvisionApi/src/InvisionComments.php';

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
        $review = new CasinoReview();
        $review->name = strip_tags($_POST["name"]);
        $review->email = strip_tags($_POST["email"]);
        $review->body = strip_tags($_POST["body"]);
        $review->ip = $this->request->getAttribute("ip");
        $review->country = $this->request->getAttribute("country")->id;
        $review->parent = (integer)$_POST["parent"];
       // $this->saveReview($_POST);

        $object = new CasinoReviews();
        $id = $object->insert($_POST["casino"], $review);

        $casino_id  = $object->getCasinoId($_POST["casino"]);

        $invision = new InvisionComments();
        $invision->setEndpoint(InvisionAppEndPoints::$endpoints['entries']['comments']['add_comment']['url']);

        $commentData = [
            'entry' => $casino_id,
            'author' => 0,
            'content' => $review->body,
            'author_name' => $review->name,
            'date' => date('Y-m-d H:i:s')

        ];
        //var_dump($commentData); die();
        $invision->addComment($commentData);

        if ($id) {
            $this->response->setAttribute("id", $id);
        } else {
            throw new OperationFailedException("Casino not found!");
        }
    }
}
