<?php
require_once("entities/Casino.php");
require_once("entities/CasinoBonus.php");
require_once("FieldValidator.php");

class Casinos implements FieldValidator
{
    public function getHighRollerNumber()
    {
        return (integer) SQL("SELECT count(*) AS nr FROM casinos WHERE is_high_roller=1")->toValue();
    }

    public function validate($name)
    {
        return SQL("SELECT name FROM casinos WHERE name=:name", array(":name"=>$name))->toValue();
    }

    public function getID($name)
    {
        return SQL("SELECT id FROM casinos WHERE name=:name", array(":name"=>$name))->toValue();
    }

    public function getName($id)
    {
        return SQL("SELECT name FROM casinos WHERE id=:id", array(":id"=>$id))->toValue();
    }

    public function getTermsLink($id)
    {
        return SQL("SELECT tc_link FROM casinos WHERE id=:id", [":id"=>$id])->toValue();
    }

    public function getBasicInfo($id)
    {
        $row = SQL("
            SELECT t1.id, t1.name, t1.code, t2.name AS status, t1.affiliate_link, t1.is_open, t4.name AS software, t5.note
            FROM casinos AS t1
            LEFT JOIN casino_statuses AS t2 ON t1.status_id = t2.id
            LEFT JOIN casinos__game_manufacturers AS t3 ON t1.id = t3.casino_id AND t3.is_primary = 1
            LEFT JOIN game_manufacturers AS t4 ON t3.game_manufacturer_id = t4.id
            LEFT JOIN casinos__notes AS t5 ON t1.id = t5.casino_id AND t5.language_id = 1
            WHERE t1.id = :id  
        ", array(":id"=>$id))->toRow();
        if (empty($row)) {
            return;
        }

        $object = new Casino();
        $object->id = $row["id"];
        $object->name = $row["name"];
        $object->code = $row["code"];
        $object->status = $row["status"];
        $object->affiliate_link = $row["affiliate_link"];
        $object->softwares = $row["software"];
        $object->is_open = $row["is_open"];
        $object->note = str_replace("www.thebigfreechiplist.com", "www.casinoslists.com", $row["note"]);
        $object->logo_big = $this->getCasinoLogo($object->code = $row["code"], "124x82");
        $object->logo_small = $this->getCasinoLogo($object->code = $row["code"], "85x56");
        return $object;
    }

    public function getBonus($casinoID, $isFree)
    {
        $query = "
        SELECT t1.casino_id, t1.codes, t1.amount, t1.wagering, t1.minimum_deposit, t1.games, t2.name 
        FROM casinos__bonuses AS t1
        INNER JOIN bonus_types AS t2 ON t1.bonus_type_id = t2.id
        WHERE t1.casino_id = $casinoID AND t2.name IN (".($isFree?"'No Deposit Bonus','Free Spins','Free Play'":"'First Deposit Bonus'").")
        ";
        $resultSet = SQL($query);
        while ($row = $resultSet->toRow()) {
            $bonus = new CasinoBonus();
            $bonus->amount = ($row["name"]=="Free Spins"?trim(str_replace("FS", "", $row["amount"])):$row["amount"]);
            $bonus->min_deposit = $row["minimum_deposit"];
            $bonus->wagering = $row["wagering"];
            $bonus->games_allowed = $row["games"];
            $bonus->code = $row["codes"];
            $bonus->type = $row["name"];
            return $bonus;
        }
    }

    public function isCountryAccepted($casinoID, $countryID)
    {
        return SQL("select casino_id from casinos__countries_allowed where casino_id=:casino_id and country_id=:country_id", [
            ":casino_id"=>$casinoID,
            ":country_id"=>$countryID
        ])->toValue();
    }

    public function rate($casinoID, $ip, $value)
    {
        if (!$casinoID) {
            return null;
        }
        $count = SQL("SELECT COUNT(id) FROM casinos__ratings WHERE casino_id = :casinoId AND ip = :ip", array(":casinoId"=>$casinoID,":ip"=>$ip))->toValue();
        if ($count == 0) {
            $affectedRows = SQL("
              INSERT INTO casinos__ratings SET 
                casino_id = :casino,
                ip = :ip,
                value = :value
                ON DUPLICATE KEY UPDATE value = :value
              ", array(":casino"=>$casinoID, ":ip"=>$ip, ":value"=>$value))->getAffectedRows();
            if ($affectedRows>0) {
                SQL(
                    "UPDATE casinos SET rating_total=rating_total+:value, rating_votes=rating_votes+1 WHERE id=:casino",
                    array(":casino"=>$casinoID, ":value"=>$value)
                );
            }
            return $affectedRows;
        } else {
            return "Casino already rated!";
        }
    }

    public function click($id)
    {
        SQL("UPDATE casinos SET clicks = clicks+1 WHERE id=:id", array(":id"=>$id));
    }

    public function getAll()
    {
        return SQL("SELECT name FROM casinos ORDER BY name ASC")->toColumn();
    }

    public function getCasinoData($id)
    {
        return SQL("SELECT id FROM casinos WHERE id ={$id}")->toRow();
    }

    private function getCasinoLogo($name, $resolution)
    {
        $logoDirPath = "/public/sync/casino_logo_light/".$resolution;
        $logoFile = strtolower(str_replace(" ", "_", $name)).".png";
        $logo = $logoDirPath.'/'.$logoFile;

        if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$logo)) {
            $logo =$logoDirPath."/no-logo-{$resolution}.png";
        }
        return $logo;
    }
}
