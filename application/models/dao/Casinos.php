<?php
require_once("entities/Casino.php");
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
        $row = DB("
            SELECT t1.id, t1.name, t2.name AS status, t1.affiliate_link, t1.is_open, t4.name AS software
            FROM casinos AS t1
            LEFT JOIN casino_statuses AS t2 ON t1.status_id = t2.id
            LEFT JOIN casinos__game_manufacturers AS t3 ON t1.id = t3.casino_id AND t3.is_primary = 1
            LEFT JOIN game_manufacturers AS t4 ON t3.game_manufacturer_id = t4.id
            WHERE t1.name = :name  
        ", array(":name"=>$name))->toRow();
        if(empty($row)) return;

        $object = new Casino();
        $object->id = $row["id"];
        $object->name = $row["name"];
        $object->status = $row["status"];
        $object->affiliate_link = $row["affiliate_link"];
        $object->softwares = $row["software"];
        $object->is_open = $row["is_open"];
        return $object;
    }

    public function rate($name, $ip, $value) {
        $casinoID = DB("SELECT id FROM casinos WHERE name=:name",array(":name"=>$name))->toValue();
        if(!$casinoID) return null;
        $affectedRows = DB("
          INSERT INTO casinos__ratings SET 
            casino_id = :casino,
            ip = :ip,
            value = :value
            ON DUPLICATE KEY UPDATE value = :value
          ", array(":casino"=>$casinoID, ":ip"=>$ip, ":value"=>$value))->getAffectedRows();
        if($affectedRows>0) {
            DB("UPDATE casinos SET rating_total=rating_total+1, rating_votes=rating_votes+:value WHERE id=:casino",
              array(":casino"=>$casinoID, ":value"=>$value));
        }
        return $affectedRows;
    }
}