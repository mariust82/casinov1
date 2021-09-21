<?php
class TestDataCasinoBonus extends Entity
{
    public $id;
    public $casino_id;
    public $bonus_type_id;
    public $codes;
    public $amount;
    public $wagering;
    public $availability;
    public $deposit_minimum;
    public $games;
    public $is_exclusive;
    public $date_modified;

    public $bonus_type_name;
}