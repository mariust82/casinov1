<?php
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
		
$this->response->setAttribute("reviews", array (
  0 => 
  array (
    'id' => 6,
    'name' => 'random#9',
    'email' => 'random#7',
    'body' => 'random#6',
    'likes' => 1,
    'country' => 'random#4',
    'rating' => 2,
    'date' => '2018-01-17 15:37:12',
    'parent' => 3,
  ),
));
	}
}
