<?php
class CasinoReview extends Entity
{
    public $id;
    public $parent_id;
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
    public $status;
}
