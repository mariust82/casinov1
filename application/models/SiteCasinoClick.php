<?php
require_once("hlis/sitebase/CasinoClick.php");
require_once "dao/Casinos.php";

class SiteCasinoClick extends CasinoClick
{
    private $info;

    protected function getCasinoStatus($name)
    {
        $object = new Casinos();
        $this->info = $object->getBasicInfo($name);
        $object->click($this->info->id);
        if (!$this->info) {
            return CasinoStatus::NOT_FOUND;
        }
        if ($this->info->status || $this->info->is_open == 0) {
            return CasinoStatus::UNACTIVE;
        }
        return CasinoStatus::ACTIVE;
    }

    protected function getWarningPage($name = "")
    {
        return '/warn/'. str_replace(" ","-", $name);
    }

    protected function getAffiliateLinkByBonus($bonusID)
    {
        return null;
    }

    protected function getAffiliateLinkByCasino($name)
    {
        return $this->info->affiliate_link;
    }

    protected function send($casinoCode) {
        $uuid = getUuid();
        $tmp = CountryDetection::getInstance()->getCountry();
        $country = ($tmp?$tmp->code:"");
        Async::send("click-casino", array("uuid"=>$uuid, "country"=>$country, "casino"=>$this->info->code));
    }
}