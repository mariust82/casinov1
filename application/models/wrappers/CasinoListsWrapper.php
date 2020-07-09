<?php
require_once 'application/helpers/CasinoHelper.php';


class CasinoListsWrapper{
    private $casinosList;

    public function __construct($casinosList){
        $this->prepareList($casinosList);
    }

    public function getCasinosList(){
        return $this->casinosList;
    }

    private function prepareList($list){
        $casinoHelper = new CasinoHelper();
        foreach($list as $casino){
            if(isset($casino['bonus_free']) && !empty($casino['bonus_free'])){
                $casino->bonus_free->amount = $casinoHelper->checkForAbbr($casino->bonus_free->amount);
                $casino->bonus_free->bonus_type_Abbreviation = $casinoHelper->getAbbreviation($casino->bonus_free->type);
            }

            if(isset($casino['bonus_first_deposit']) && !empty($casino['bonus_free'])){
                $casino->bonus_first_deposit->amount = $casinoHelper->checkForAbbr($casino->bonus_first_deposit->amount);
                if(!preg_match('[FS|NDB|CB|FDB]', $casino->bonus_first_deposit->amount)) {
                    $casino->bonus_first_deposit->bonus_type_Abbreviation = $casinoHelper->getAbbreviation($casino->bonus_first_deposit->type);
                }
            }

            $this->casinosList[$casino["id"]] = $casino;
        }
    }
}