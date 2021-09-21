<?php
class TestDataCasino extends Entity
{
    public $id;
    public $name;
    public $code;
    public $casino_bonuses = [];


    public $is_open;
    public $is_live_chat;
    public $deposit_minimum;
    public $withdraw_minimum;
    public $affiliate_program_id;
    public $date;
    public $date_established;
    public $status_id;
    public $priority;
    public $affiliate_link;
    public $date_added;
    public $tc_link;
    public $email_link;
}