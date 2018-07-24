<?php
require_once("entities/Casino.php");
require_once("entities/CasinoBonus.php");
require_once("FieldValidator.php");

class Casinos implements FieldValidator
{
    public function getHighRollerNumber() {
        return (integer) DB("SELECT count(*) AS nr FROM casinos WHERE is_high_roller=1")->toValue();
    }

    public function validate($name) {
        return DB("SELECT name FROM casinos WHERE name=:name",array(":name"=>$name))->toValue();
    }

    public function getID($name) {
        return DB("SELECT id FROM casinos WHERE name=:name",array(":name"=>$name))->toValue();
    }

    public function getBasicInfo($name) {
	DB("SET names UTF8");
        $row = DB("
            SELECT t1.id, t1.name, t1.code, t2.name AS status, t1.affiliate_link, t1.is_open, t4.name AS software, t5.note
            FROM casinos AS t1
            LEFT JOIN casino_statuses AS t2 ON t1.status_id = t2.id
            LEFT JOIN casinos__game_manufacturers AS t3 ON t1.id = t3.casino_id AND t3.is_primary = 1
            LEFT JOIN game_manufacturers AS t4 ON t3.game_manufacturer_id = t4.id
            LEFT JOIN casinos__notes AS t5 ON t1.id = t5.casino_id AND t5.language_id = 1
            WHERE t1.name = :name  
        ", array(":name"=>$name))->toRow();
        if(empty($row)) return;

        $object = new Casino();
        $object->id = $row["id"];
        $object->name = $row["name"];
        $object->code = $row["code"];
        $object->status = $row["status"];
        $object->affiliate_link = $row["affiliate_link"];
        $object->softwares = $row["software"];
        $object->is_open = $row["is_open"];
        $object->note = str_replace("www.thebigfreechiplist.com", "www.casinoslists.com", $row["note"]);

        return $object;
    }

    public function getBonus($casinoID, $isFree) {
        DB("SET names UTF8");
        $query = "
        SELECT t1.casino_id, t1.codes, t1.amount, t1.wagering, t1.minimum_deposit, t1.games, t2.name 
        FROM casinos__bonuses AS t1
        INNER JOIN bonus_types AS t2 ON t1.bonus_type_id = t2.id
        WHERE t1.casino_id = $casinoID AND t2.name IN (".($isFree?"'No Deposit Bonus','Free Spins','Free Play'":"'First Deposit Bonus'").")
        ";
        $resultSet = DB($query);
        while($row = $resultSet->toRow()) {
            $bonus = new CasinoBonus();
            $bonus->amount = ($row["name"]=="Free Spins"?trim(str_replace("FS","",$row["amount"])):$row["amount"]);
            $bonus->min_deposit = $row["minimum_deposit"];
            $bonus->wagering = $row["wagering"];
            $bonus->games_allowed = $row["games"];
            $bonus->code = $row["codes"];
            $bonus->type = $row["name"];
            return $bonus;
        }
    }

    public function rate($name, $ip, $value) {
        $casinoID = DB("SELECT id FROM casinos WHERE name=:name",array(":name"=>$name))->toValue();
        if(!$casinoID) return null;
        $count = DB("SELECT COUNT(id) FROM casinos__ratings WHERE casino_id = :casinoId AND ip = :ip",array(":casinoId"=>$casinoID,":ip"=>$ip))->toValue();
        if ($count == 0) {
            $affectedRows = DB("
              INSERT INTO casinos__ratings SET 
                casino_id = :casino,
                ip = :ip,
                value = :value
                ON DUPLICATE KEY UPDATE value = :value
              ", array(":casino"=>$casinoID, ":ip"=>$ip, ":value"=>$value))->getAffectedRows();
            if($affectedRows>0) {
                DB("UPDATE casinos SET rating_total=rating_total+:value, rating_votes=rating_votes+1 WHERE id=:casino",
                  array(":casino"=>$casinoID, ":value"=>$value));
            }
            return $affectedRows;
        } else {
            return "Casino already rated!";
        }
        
    }

    public function click($id) {
        DB("UPDATE casinos SET clicks = clicks+1 WHERE id=:id",array(":id"=>$id));
    }

    public function getAll() {
        return DB("SELECT name FROM casinos ORDER BY name ASC")->toColumn();
    }
}
