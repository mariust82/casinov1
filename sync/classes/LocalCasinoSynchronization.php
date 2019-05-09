<?php
/**
 * Created by PhpStorm.
 * User: aherne
 * Date: 18.01.2018
 * Time: 11:14
 */

class LocalCasinoSynchronization extends NewCasinoSynchronization
{
    protected function setLabels($casinoID, $info) {

        DB::execute("DELETE FROM casinos__labels WHERE casino_id = ".$casinoID);
        foreach($info["labels"] as $line) {
            if($line["id"]>3) continue;
            DB::execute("INSERT IGNORE INTO casinos__labels SET casino_id=:casino_id, label_id=:label_id",array(
                ":casino_id"=>$casinoID,
                ":label_id"=>$line["id"]
            ));
        }

        if($info["is_open"]) {
            // add best ( WHERE is_open=1 AND `score`>7.3 )
            $rand = rand(0,9);
            if($rand == 0 && !$info["status"]) {
                DB::execute("INSERT IGNORE INTO casinos__labels SET casino_id=:casino_id, label_id=:label_id",array(
                    ":casino_id"=>$casinoID,
                    ":label_id"=>7
                ));
            }

            // deletes the casino if it has the label best but it's status_id is not 0
            if($info["status"]['id'] != 0 ){
                DB::execute("Delete from casinos__labels where casino_id=:casino_id and label_id=:label_id",array(
                    ":casino_id"=>$casinoID,
                    ":label_id"=>7
                ));
            }

            // add safe ( WHERE is_open=1 AND (`wd_cred`+`casino_fairness`)/2>7.3 )
            $rand = rand(0,9);
            if($rand == 0 && !$info["status"]) {
                DB::execute("INSERT IGNORE INTO casinos__labels SET casino_id=:casino_id, label_id=:label_id",array(
                    ":casino_id"=>$casinoID,
                    ":label_id"=>8
                ));
            }

            // add stay away
            if($info["status"] && $info["status"]["name"]=="Blacklisted") {
                DB::execute("INSERT IGNORE INTO casinos__labels SET casino_id=:casino_id, label_id=:label_id",array(
                    ":casino_id"=>$casinoID,
                    ":label_id"=>9
                ));
            }
        }
    }

    protected function saveNewState($data) {
        $maxDate = "";
        foreach($data as $item) {
            $casinoID = $item["id"];
            $this->setCasino($item);
            $this->setBonuses($casinoID, $item["bonuses"]);
            $this->setCertifications($casinoID, $item["certifications"]);
            $this->setCountries($casinoID, $item["countries"]);
            $this->setCurrencies($casinoID, $item["currencies"]);
            $this->setDepositMethods($casinoID, $item["deposit_methods"]);
            $this->setEmails($casinoID, $item["emails"]);
            $this->setFaxes($casinoID, $item["faxes"]);
            $this->setSoftwares($casinoID, $item["game_manufacturers"]);
            $this->setLabels($casinoID, $item);
            $this->setLanguages($casinoID, $item["languages"]);
            $this->setLicenses($casinoID, $item["licenses"]);
            $this->setNotes($casinoID, $item["notes"]);
            $this->setOperatingSystems($casinoID, $item["operating_systems"]);
            $this->setPhones($casinoID, $item["phones"]);
            $this->setPlayVersions($casinoID, $item["play_versions"]);
            $this->setWithdrawMaximums($casinoID, $item["withdraw_maximums"]);
            $this->setWithdrawMethods($casinoID, $item["withdraw_methods"]);
            $this->setWithdrawTimeframes($casinoID, $item["withdraw_timeframes"]);
            $this->setGameTypes($casinoID, $item["game_types"]);
            if($item["date"]>$maxDate) $maxDate = $item["date"];
        }
        return $maxDate;
    }
}