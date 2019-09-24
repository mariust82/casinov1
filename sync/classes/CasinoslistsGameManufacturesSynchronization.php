<?php
require_once("src/controllers/NewGameManufacturersSynchronization.php");

class CasinoslistsGameManufacturesSynchronization extends NewGameManufacturersSynchronization
{
    protected function setSoftware($item)
    {
        $updates = array();
        $this->setName($updates, $item["name"]);
        $this->setPriority($updates, $item["priority"]);
        if (isset($this->softwares[$item["id"]])) {
            DB::execute("UPDATE game_manufacturers SET ".$this->getQuerySet($updates)." WHERE id = ".$item["id"], $updates);
        } else {
            $updates["id"] = $item["id"];
            DB::execute("INSERT INTO game_manufacturers SET ".$this->getQuerySet($updates), $updates);
        }
    }
    
    protected function setCountries($softwareID, $countries)
    {
        return;
    }
}
