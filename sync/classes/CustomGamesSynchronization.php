<?php
class CustomGamesSynchronization extends NewGameSynchronization
{
    protected function destroy() {
        if($this->dataUpdated) {
            chdir(dirname(__DIR__, 2));
            require ("vendor/autoload.php");
            $maintenance = new Lucinda\DB\DatabaseMaintenance(dirname(__DIR__,2)."/xml/file_db.xml", $this->application->getEnvironment());
            $maintenance->deleteByTag("game");
        }
        
        Cron::destroy();
    }
}