<?php
/**
 * Created by PhpStorm.
 * User: aherne
 * Date: 18.01.2018
 * Time: 11:14
 */
require_once(dirname(__DIR__, 2)."/application/models/dao/entities/Entity.php");
require_once(dirname(__DIR__, 2)."/application/models/dao/BestCasinoLabel.php");
require_once(dirname(__DIR__, 2)."/application/models/dao/LowWageringCasinoLabel.php");
require_once(dirname(__DIR__, 2)."/application/models/dao/NoAccountLabel.php");

class CustomCasinosSynchronization extends NewCasinoSynchronization
{
    protected function destroy() {
        if($this->dataUpdated) {
            // update labels
            $object = new NoAccountLabel();
            $object->resetNoAccountLabelFromSync();
            $object->populateNoAccountLabel();
            
            $object = new BestCasinoLabel(true);
            $object->resetBestLabelFromSync();
            $object->populateBestLabel();
            
            $object = new LowWageringCasinoLabel();
            $object->resetLowWageringLabel();
            $object->populateLowWageringLabel();
            
            // update cache
            chdir(dirname(__DIR__, 2));
            require_once("hlis/query_cache/MongoDriver.php");
            $cache = new \Hlis\QueryCache\MongoDriver("casinoslists.cache_".$this->application->getEnvironment());
            $cache->delete(["is_casino"=>true]);
            
            Cron::destroy();
        }
    }
    
    protected function setLabels($casinoID, $info)
    {
        DB::execute("DELETE FROM casinos__labels WHERE casino_id = ".$casinoID);

        foreach ($info["labels"] as $line) {
            if ($line["id"]>3) {
                continue;
            }
            DB::execute("INSERT IGNORE INTO casinos__labels SET casino_id=:casino_id, label_id=:label_id", array(
                ":casino_id"=>$casinoID,
                ":label_id"=>$line["id"]
            ));
        }

        if ($info["is_open"]) {

            // add safe ( WHERE is_open=1 AND (`wd_cred`+`casino_fairness`)/2>7.3 )
            $rand = rand(0, 9);
            if ($rand == 0 && !$info["status"]) {
                DB::execute("INSERT IGNORE INTO casinos__labels SET casino_id=:casino_id, label_id=:label_id", array(
                    ":casino_id"=>$casinoID,
                    ":label_id"=>8
                ));
            }

            // add stay away
            if ($info["status"] && $info["status"]["name"]=="Blacklisted") {
                DB::execute("INSERT IGNORE INTO casinos__labels SET casino_id=:casino_id, label_id=:label_id", array(
                    ":casino_id"=>$casinoID,
                    ":label_id"=>9
                ));
            }
        }
    }

    protected function saveNewState($data)
    {
        $maxDate = "";
        foreach ($data as $item) {
            $casinoID = $item["id"];
            $this->setCasino($item);
            $this->setBonuses($casinoID, $item["bonuses"]);
            $this->setCertifications($casinoID, $item["certifications"]);
            $this->setCountries($casinoID, $item["countries"]);
            $this->setCountriesAllowed($casinoID, $item["countries"]);
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
            $this->setRegistrationCasino($casinoID, $item["no_registration"]);
            if ($item["date"]>$maxDate) {
                $maxDate = $item["date"];
            }
        }
        return $maxDate;
    }

    private function setRegistrationCasino($casinoID, $registration)
    {
        if (empty((int)$registration)) {
            $query = "UPDATE casinos SET no_registration = 0 WHERE id = " . $casinoID;
            DB::execute($query);
            return;
        }

        // update casino
        $query = "UPDATE casinos SET no_registration = 1 WHERE id = " . $casinoID;
        DB::execute($query);
    }
}
