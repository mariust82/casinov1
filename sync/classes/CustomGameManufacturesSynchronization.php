<?php
class CustomGameManufacturesSynchronization extends NewGameManufacturersSynchronization
{
    protected function destroy() {
        if($this->dataUpdated) {
            chdir(dirname(__DIR__, 2));
            require ("vendor/autoload.php");
            $maintenance = new Lucinda\DB\DatabaseMaintenance(dirname(__DIR__,2)."/xml/file_db.xml", $this->application->getEnvironment());
            $maintenance->deleteByTag("game-manufacturer");
        }
        
        Cron::destroy();
    }
    
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
