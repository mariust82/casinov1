<?php
require_once 'application/models/dao/entities/CasinoBonus.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TopPicks
 *
 * @author matan
 */
class TopPicks {

    private $picks;

    public function __construct() {
        $this->picks = $this->setTopPicks();
    }

    public function getTopPicks() {
        return $this->picks;
    }

    private function setTopPicks() {
        $resultSet = SQL("SELECT t2.* FROM `top_picks` AS `t1` 
        INNER JOIN `casinos` AS `t2` ON (`t1`.`n_c_id` = `t2`.`id`) 
        WHERE `t1`.`date`='" . date("Y-m-01") . "'");

        while ($row = $resultSet->toRow()) {
            $object = new Casino();
            $object->id = $row["id"];
            $object->name = $row["name"];
            $object->code = $row["code"];
            $object->is_country_accepted = $row["is_country_supported"];
            $object->date_established = $row["date_established"];
            $object->date_formatted = $this->formatDate($row["date_established"]);
            $object->status = $row["status_id"];
            $object->is_tc_link = $row["is_tc_link"];
            $object->logo_big = $this->getCasinoLogo($object->code = $row["code"], "124x82"); //  $object->logo_big = "/public/sync/casino_logo_light/124x82/".strtolower(str_replace(" ", "_", $object->code)).".png";
            $object->logo_small = $this->getCasinoLogo($object->code = $row["code"], "85x56");//   $object->logo_small = "/public/sync/casino_logo_light/85x56/".strtolower(str_replace(" ", "_", $object->code)).".png";
            $object->new = $this->isCasinoNew($row["date_established"]);
            $object->score_class = $this->getScoreClass($object->rating);
            if ($this->filter->getBankingMethod()) {
                $object->deposit_methods = $row["has_dm"];
                $object->withdraw_methods = $row["has_wm"];
            }
            $output[$row["id"]] = $object;
        }
        if (empty($output)) {
            return array();
        }
        
        // append bonuses
        $query = "
        SELECT t1.casino_id, t1.codes, t1.amount, t1.wagering, t1.deposit_minimum, t1.games, t2.name , t1.bonus_type_id
        FROM casinos__bonuses AS t1
        INNER JOIN bonus_types AS t2 ON t1.bonus_type_id = t2.id
        WHERE t1.casino_id IN (".implode(",", array_keys($output)).") AND t2.name IN ('No Deposit Bonus','First Deposit Bonus','Free Spins','Free Play')
        ";
        $resultSet = SQL($query);
        while ($row = $resultSet->toRow()) {
            $bonus = new CasinoBonus();
            $bonus->amount = ($row["name"]=="Free Spins"?trim(str_replace("FS", "", $row["amount"])):$row["amount"]);
            $bonus->amount = $this->checkForAbbr($bonus->amount);
            $bonus->min_deposit = $row["deposit_minimum"];
            if ($row["wagering"] == '') {
                $row["wagering"] = 0;
            }
            $bonus->wagering = $row["wagering"];
            $bonus->games_allowed = $row["games"];
            $bonus->code = $row["codes"];
            $bonus->type = $row["name"];
            if ($row["name"]=="No Deposit Bonus" || $row["name"]=="Free Spins" || $row["name"]=="Free Play" || $row["name"]=="Bonus Spins") {
                $output[$row["casino_id"]]->bonus_free = $bonus;
            } else {
                $output[$row["casino_id"]]->bonus_first_deposit = $bonus;
            }
        }
        
        return array_values($output);
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
