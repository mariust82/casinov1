<?php
class CasinoListsWrapper{
    private $casinosList;

    public function __construct($casinosList){
        $this->prepareList($casinosList);
    }

    public function getCasinosList(){
        return $this->casinosList;
    }

    private function prepareList($list){
        foreach($list as $casino){
            if(isset($casino['bonus_free']) && !empty($casino['bonus_free'])){
                $casino->bonus_free->amount = $this->checkForAbbr($casino->bonus_free->amount);
                $casino->bonus_free->bonus_type_Abbreviation = $this->getAbbreviation($casino->bonus_free->type);
            }

            if(isset($casino['bonus_first_deposit']) && !empty($casino['bonus_free'])){
                $casino->bonus_first_deposit->amount = $this->checkForAbbr($casino->bonus_first_deposit->amount);
                if(!preg_match('[FS|NDB|CB|FDB]', $casino->bonus_first_deposit->amount)) {
                    $casino->bonus_first_deposit->bonus_type_Abbreviation = $this->getAbbreviation($casino->bonus_first_deposit->type);
                }
            }
            
            $this->casinosList[$casino["id"]] = $casino;
        }
    }

    private function getAbbreviation($name)
    {
        $words = explode(" ", $name);
        $abbr = "";

        foreach ($words as $word) {
            $abbr .= $word[0];
        }
        return $abbr;
    }

    private function checkForAbbr($amount) {
        if (strpos($amount, 'FS') !== false) {
            return str_replace("FS",'<abbr title="Free Spins"> FS',$amount);
        }
        if (strpos($amount, 'NDB') !== false) {
            return str_replace("NDB",'<abbr title="No Deposit Bonus"> NDB',$amount);
        }
        if (strpos($amount, 'CB') !== false) {
            return str_replace("CB",'<abbr title="Cashback "> CB',$amount);
        }
        if (strpos($amount, 'FDB') !== false) {
            return str_replace("FDB",'<abbr title="First Deposit Bonus"> FDB',$amount);
        }
        return $amount;
    }

}