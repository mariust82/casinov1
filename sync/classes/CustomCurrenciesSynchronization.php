<?php
class CustomCurrenciesSynchronization extends CurrenciesSynchronization
{
    /**
     * @param $item
     */
    protected function setCurrency($item)
    {
        $updates = array();
        $this->setCode($updates, $item["code"]);
        $this->setSymbol($updates, $item["symbol"]);
        $this->setIsCrypto($updates, $item["is_crypto"]);
        if (isset($this->currencies[$item["id"]])) {
            DB::execute("UPDATE currencies SET " . $this->getQuerySet($updates) . " WHERE id = " . $item["id"], $updates);
        } else {
            $updates["id"] = $item["id"];
            DB::execute("INSERT INTO currencies SET " . $this->getQuerySet($updates), $updates);
        }
    }

    /**
     * @param $updates
     * @param $value
     */
    protected function setIsCrypto(&$updates, $value)
    {
        $updates["is_crypto"] = $value;
    }

}