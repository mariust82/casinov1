<?php
class Subscriptions
{
    public function save($email, $ip, Country $country) {
        $affectedRows = DB("INSERT IGNORE INTO subscriptions SET email=:email, ip=:ip, country_id=:country", array(":email"=>$email, ":ip"=>$ip, ":country"=>$country->id))->getAffectedRows();
        return $affectedRows;
    }
}