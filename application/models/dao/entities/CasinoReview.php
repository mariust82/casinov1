<?php
class CasinoReview {
	public $id;
	public $name;
	public $email;
	public $body;
	public $likes;
    public $ip;
	public $country;
	public $rating;
	public $date;
	public $parent;
    public $children = array();
    public $total_children = 0;
    public $review_invision_id = 0;
    public $status;
    public $invision_url = '';
}