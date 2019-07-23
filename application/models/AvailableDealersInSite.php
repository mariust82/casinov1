<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 23-Jul-19
 * Time: 11:28 AM
 */

class AvailableDealersInSite
{
    private $in_site = ["Roulette","Blackjack","Baccarat","Craps"];
    private $special_case = ['Live Dealer'];

    public function getItems(){
        return $this->in_site;
    }

    public function getSpecialCase(){
        return $this->special_case;
    }
}