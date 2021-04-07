<?php
class CustomBankingMethodsSynchronization extends BankingMethodsSynchronization
{
    protected function destroy() {
        if($this->dataUpdated) {
            chdir(dirname(__DIR__, 2));
            require_once("hlis/query_cache/MongoDriver.php");
            $cache = new \Hlis\QueryCache\MongoDriver("casinoslists.cache_".$this->application->getEnvironment());
            $cache->delete(["is_banking_method"=>true]);
            
            Cron::destroy();
        }
    }
}
