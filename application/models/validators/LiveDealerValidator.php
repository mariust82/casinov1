<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 22-Jul-19
 * Time: 11:41 AM
 */

class LiveDealerValidator extends \Lucinda\RequestValidator\ParameterValidator
{
    public function validate($type)
    {
        if (empty($type)) {
            return null;
        }

        $value = str_replace("-", " ", $type);

        switch($value){
            case 'roulette':
                return 'Roulette';
            case 'blackjack':
                return 'Blacljack';
            case 'baccarat':
                return 'Baccarat';
            case 'craps':
                return 'Craps';
            default:
                return null;
        }

    }
}