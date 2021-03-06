<?php
require_once("hlis/CasinoClick.php");
require_once "dao/Casinos.php";

class SiteCasinoClick extends CasinoClick
{
    private $info;

    protected function getCasinoStatus($id)
    {
        $object = new Casinos();
        $this->info = $object->getBasicInfo($id);

        if (!$this->info) {
            throw new Lucinda\MVC\STDOUT\PathNotFoundException();
        }

        $object->click($this->info->id);
        if (in_array($this->info->status, ["Warning","Blacklisted"]) || $this->info->is_open == 0) {
            return CasinoStatus::UNACTIVE;
        }
        return CasinoStatus::ACTIVE;
    }

    protected function getWarningPage($id = "")
    {
        $casino = new Casinos();
        $name = $casino->getName($id);
        return '/warn/'. str_replace(" ", "-", strtolower($name));
    }

    protected function getAffiliateLinkByBonus($bonusID)
    {
        return null;
    }

    protected function getAffiliateLinkByCasino($name,$sourceId)
    {
        if ($sourceId == "email" && !empty($this->info->email_link)) {
            return $this->info->email_link;
        }
        return $this->info->affiliate_link;
    }

	protected function send($casinoCode) {
                $uuid = getUuid();
                $tmp = CountryDetection::getInstance()->getCountry();
                $country = ($tmp?$tmp->code:"");
		$casinoCode = SQL("SELECT code FROM casinos WHERE id=:id", [":id"=>$casinoCode])->toValue();
                Async::send("click-casino", array("uuid"=>$uuid, "country"=>$country, "casino"=>$casinoCode));
        }

}
