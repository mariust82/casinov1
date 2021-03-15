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
    
    public function getWithdrawTimeframes($id)
    {
        $output = array();
        $resultSet = SQL("
        SELECT t1.start, t1.end, t1.unit, t2.name 
        FROM casinos__withdraw_timeframes AS t1
        LEFT JOIN banking_method_types AS t2 ON t1.banking_method_type_id = t2.id
        WHERE casino_id = ".$id."
        ORDER BY t2.position ASC
        ");
        while ($row = $resultSet->toRow()) {
            if ($row["end"]==0) {
                $output[$row["name"]] = "instant";
            } elseif ($row["end"]==1) {
                $output[$row["name"]] = "up to 1 ".($row["unit"]=="hour"?"hour":"business day");
            } elseif ($row["start"]==0) {
                $output[$row["name"]] = "up to ".$row["end"]." ".($row["unit"]=="hour"?"hours":"business days");
            } else {
                $output[$row["name"]] = "".$row["start"]."-".$row["end"]." ".($row["unit"]=="hour"?"hours":"business days");
            }
        }
        return $output;
    }

    public function getBasicInfo($id)
    {
        $row = SQL("
            SELECT t1.id, t1.name, t1.code,t1.email_link, t2.name AS status, t1.affiliate_link, t1.is_open, t4.name AS software, t5.value AS note
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
        $object->email_link = $row['email_link'];
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
        SELECT t1.casino_id, t1.codes, t1.amount, t1.wagering, t1.deposit_minimum, t1.games, t2.name 
        FROM casinos__bonuses AS t1
        INNER JOIN bonus_types AS t2 ON t1.bonus_type_id = t2.id
        WHERE t1.casino_id = $casinoID AND t2.name IN (".($isFree?"'No Deposit Bonus','Free Spins','Free Play','Bonus Spins'":"'First Deposit Bonus'").")
        ";
        $resultSet = SQL($query);
        while ($row = $resultSet->toRow()) {
            $bonus = new CasinoBonus();
            $bonus->amount = ($row["name"]=="Free Spins"?trim(str_replace("FS", "", $row["amount"])):$row["amount"]);
            $bonus->min_deposit = $row["deposit_minimum"];
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
        $currentVote = SQL("SELECT value FROM casinos__ratings WHERE casino_id = :casinoId AND ip = :ip", array(":casinoId"=>$casinoID,":ip"=>$ip))->toValue();
        $extra_query = '';
        if (empty($currentVote)) {

            $affectedRows = SQL("
              INSERT INTO casinos__ratings SET 
                casino_id = :casino,
                ip = :ip,
                value = :value
                ON DUPLICATE KEY UPDATE value = :value
              ", array(":casino"=>$casinoID, ":ip"=>$ip, ":value"=>$value))->getAffectedRows();
            $extra_query = ', rating_votes=rating_votes+1 ';
        } else {
            $affectedRows = SQL("
              UPDATE casinos__ratings SET 
                value = :value
                WHERE ip = :ip AND casino_id = :casino
              ", array(":casino"=>$casinoID, ":ip"=>$ip, ":value"=>$value))->getAffectedRows();
        }

        if ($affectedRows>0) {
            SQL(
                "UPDATE casinos SET rating_total=rating_total - :currentVote + :value" . $extra_query . " WHERE id=:casino",
                array(":casino"=>$casinoID, ":value"=>$value, ":currentVote" => $currentVote)
            );
        }

        return $affectedRows;
    }

    public function click($id)
    {
        SQL("UPDATE casinos SET clicks = clicks+1 WHERE id=:id", array(":id"=>$id));
    }

    public function getAllByDate()
    {
        return SQL("SELECT name, date FROM casinos ORDER BY date DESC")->toMap("name", "date");
    }
    
    public function getLastModNDB() {
        return SQL("
        SELECT MAX(t1.date) FROM casinos AS t1
        INNER JOIN casinos__bonuses AS t4 ON t1.id = t4.casino_id AND t4.bonus_type_id IN (3,4,5,6,11)
        WHERE t1.is_open = 1")->toValue();
    }
    
    public function getLastModMobile() {
        return SQL("
        SELECT MAX(t1.date) FROM casinos AS t1 
        INNER JOIN casinos__play_versions AS t9 ON t1.id = t9.casino_id AND t9.play_version_id = (SELECT id FROM play_versions WHERE name = 'mobile')
        WHERE t1.is_open = 1")->toValue();
    }
    
    public function getLastModEcogra() {
        return SQL("
        SELECT MAX(t1.date) FROM casinos AS t1 
        INNER JOIN casinos__certifications AS t6 ON t1.id = t6.casino_id AND t6.certification_id = (SELECT id FROM certifications WHERE name = 'ecogra')
        WHERE t1.is_open = 1")->toValue();
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
    
    public function getAllByLabels($countryID) {
        $output = [];
        $labels = ["Best", "Low Minimum Deposit", "New", "Blacklisted Casinos", "Low Wagering", "No Account Casinos", "Fast Payout"];
        foreach ($labels as $label) {
            $order = 't1.priority DESC, t1.id DESC';
            
            if ($label == 'New') {
                $now = date("Y-m-d");
                $date = strtotime($now . ' -1 year');
                $last = date('Y-m-d', $date);
                $output[$label] = SQL("
                SELECT MAX(t1.date) FROM casinos AS t1 
                WHERE t1.is_open = 1 AND t1.date_established > '{$last}' 
                ORDER BY t1.date_established DESC, t1.priority DESC, t1.id DESC")->toValue();
            } elseif ($label == "Low Minimum Deposit") {
                $output[$label] = SQL("
                SELECT MAX(t1.date) FROM casinos AS t1 
                INNER JOIN casinos__currencies AS cc ON t1.id = cc.casino_id
                INNER JOIN currencies AS c ON c.id = cc.currency_id
                WHERE t1.is_open = 1 AND t1.deposit_minimum BETWEEN 1 AND 5
                AND cc.is_primary = 1 AND c.is_crypto = 0
                ORDER BY t1.deposit_minimum ASC, t1.priority DESC, t1.name ASC")->toValue();
            } elseif ($label == 'Fast Payout') {
                $output[$label] = SQL("SELECT  MAX(t1.date) FROM casinos AS t1 LEFT OUTER JOIN casinos__currencies AS t15 ON t1.id = t15.casino_id LEFT OUTER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id AND t2.country_id = {$countryID} INNER JOIN casinos__withdraw_timeframes AS t18 ON t1.id = t18.casino_id AND t18.unit = 'hour' AND t18.end <= 24 LEFT OUTER JOIN casino_statuses AS cs ON t1.status_id = cs.id WHERE t1.is_open = 1 ORDER BY t18.end ASC, t1.priority DESC")->toValue();
            } else {
                switch ($label) {
                    case 'Best':
                        $order = 'ORDER BY (t1.rating_total/t1.rating_votes)  DESC, t1.priority DESC, t1.id DESC ';
                        break;
                    case 'Low Wagering':
                        $order = 'ORDER BY t5.id ASC ';
                        break;
                    case 'No Account Casinos':
                        $order = 'ORDER BY t1.priority DESC, t1.date_established DESC, t1.id DESC';
                        break;
                    default:
                        $order = 'ORDER BY t1.priority DESC, t1.id DESC ';
                        break;
                }
                $output[$label] = SQL("
                SELECT MAX(t1.date) FROM casinos AS t1 
                INNER JOIN casinos__labels AS t5 ON t1.id = t5.casino_id AND t5.label_id = (SELECT id FROM casino_labels WHERE name = '{$label}')
                WHERE t1.is_open = 1
                {$order}")->toValue();
            }
        }
        array_multisort($output, SORT_DESC);
        return $output;
    }
    
    public function getAllByCountries() {
        $res = SQL("
        SELECT MAX(t1.date) AS data, t3.name FROM casinos AS t1
        INNER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id
        INNER JOIN countries AS t3 ON t2.country_id = t3.id
        WHERE t1.is_open = 1
        GROUP BY t3.name
        ORDER BY t3.name ASC
        ")->toMap("name", "data");
        $output = [];
        foreach ($res as $key => $value) {
            $name = strtolower(str_replace(" ", "-", str_replace(["(",")","'"],["","",""], $key)));
            $output[$name] = $value;
        }
        return $output;
    }

    public function getUserVotes($casino_id){
        return SQL("SELECT value from casinos__ratings WHERE casino_id = :casino_id and status != 3", array(":casino_id" => $casino_id));
    }

    public function getCasinoScore($casinoID)
    {
        return SQL("SELECT SUM(value) / COUNT(value) AS average FROM casinos__ratings WHERE casino_id = {$casinoID}")->toValue();
    }

    public function getAllVotes($casinoID){
        return SQL("SELECT COUNT(value) from casinos__ratings WHERE casino_id = :casino_id and status != 3", array(":casino_id" => $casinoID))->toValue();
    }
}
