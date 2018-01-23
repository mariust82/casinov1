<?php
require_once("entities/Casino.php");
require_once("entities/CasinoBonus.php");

class CasinoInfo
{
    private $result;

    public function __construct($name, $countryId) {
        $this->setResult($name, $countryId);
    }

    private function setResult($name, $countryId) {
        $resultSet = DB("
        SELECT t1.*, IF(t3.id IS NOT NULL, 1, 0) AS is_live_dealer, t4.name AS status, (t1.rating_total/t1.rating_votes) AS average_rating, t2.name AS affiliate_program
        FROM casinos AS t1
        LEFT JOIN affiliate_programs AS t2 ON t1.affiliate_program_id = t2.id
        LEFT JOIN casinos__play_versions AS t3 ON t1.id = t3.casino_id AND t3.play_version_id = 2
        LEFT JOIN casino_statuses AS t4 ON t1.status_id = t4.id
        WHERE t1.name=:name",array(":name"=>$name));
        $output = null;
        while($row = $resultSet->toRow()) {
            $output = new Casino();
            $output->id = $row["id"];
            $output->name = $row["name"];
            $output->rating = $row["average_rating"];
            $output->is_live_dealer = $row["is_live_dealer"];
            $output->is_live_chat = $row["is_live_chat"];
            $output->date_established = $row["date_established"];
            $output->affiliate_program = $row["affiliate_program"];
            $output->withdrawal_minimum = $row["withdraw_minimum"];
            $output->status = $row["status"];
        }
        if(!$output) return;

        // detect primary currencies & append to withdrawal minimum
        $primaryCurrencies = implode("/", $this->getPrimaryCurrencies($output->id));
        if($output->withdrawal_minimum) $output->withdrawal_minimum = $primaryCurrencies.$output->withdrawal_minimum;

        // append softwares
        $output->softwares = $this->getDerivedData("game_manufacturers", "game_manufacturer_id", $output->id);
        $output->languages = $this->getDerivedData("languages", "language_id", $output->id);
        $output->currencies = $this->getDerivedData("currencies", "currency_id", $output->id, "code"); // should be code
        $output->emails = $this->getDerivedData("emails", "", $output->id);
        $output->phones = $this->getDerivedData("phones", "", $output->id);
        $output->licenses = $this->getDerivedData("licenses", "license_id", $output->id);
        $output->certifiers = $this->getDerivedData("certifications", "certification_id", $output->id);
        $output->deposit_methods = $this->getBankingMethodData("deposit_methods", $output->id);
        $output->withdraw_methods = $this->getBankingMethodData("withdraw_methods", $output->id);
        $output->withdrawal_limits = $this->getWithdrawLimits($output->id, $primaryCurrencies);
        $output->withdrawal_timeframes = $this->getWithdrawTimeframes($output->id);
        $output->bonus_first_deposit = $this->getBonus($output->id,  2);
        $output->bonus_free = $this->getBonus($output->id, 6);

        $this->appendCountryInfo($output, $countryId);

        $this->result = $output;
    }

    private function getPrimaryCurrencies($id) {
        return DB("
                SELECT
                t2.symbol
                FROM casinos__currencies AS t1
                INNER JOIN currencies AS t2 ON t1.currency_id = t2.id
                WHERE t1.casino_id = ".$id."
            ")->toColumn();
    }

    private function getDerivedData($entity, $linkingColumn, $id, $columnName="name") {
        if($linkingColumn) {
            return DB("
                SELECT
                t2.".$columnName."
                FROM casinos__".$entity." AS t1
                INNER JOIN ".$entity." AS t2 ON t1.".$linkingColumn." = t2.id
                WHERE t1.casino_id = ".$id."
            ")->toColumn();
        } else {
            return DB("
                SELECT value 
                FROM casinos__".$entity." 
                WHERE casino_id = ".$id."
            ")->toColumn();
        }
    }

    private function getBankingMethodData($entity, $id) {
        return DB("
            SELECT
            t2.name
            FROM casinos__".$entity." AS t1
            INNER JOIN banking_methods AS t2 ON t1.banking_method_id = t2.id
            WHERE t1.casino_id = ".$id."
        ")->toColumn();
    }

    private function getWithdrawLimits($id, $currencies) {
        $output = array();
        $resultSet = DB("SELECT * FROM casinos__withdraw_maximums WHERE casino_id = ".$id);
        while($row = $resultSet->toRow()) {
            if(!$row["unit"]) {
                $output[] = "none";
            } else {
                $output[] = $currencies.$row["amount"]." per ".$row["unit"];
            }

        }
        return $output;
    }

    private function getWithdrawTimeframes($id) {
        $output = array();
        $resultSet = DB("
        SELECT t1.start, t1.end, t1.unit, t2.name 
        FROM casinos__withdraw_timeframes AS t1
        LEFT JOIN banking_method_types AS t2 ON t1.banking_method_type_id = t2.id
        WHERE casino_id = ".$id."
        ORDER BY t2.position ASC
        ");
        while($row = $resultSet->toRow()) {
            if($row["end"]==0) {
                $output[] = $row["name"]." - immediate";
            } else if($row["end"]==1) {
                $output[] = $row["name"]." - up to 1 ".($row["unit"]=="hour"?"hour":"business day");
            } else if($row["start"]==0) {
                $output[] = $row["name"]." - up to ".$row["end"]." ".($row["unit"]=="hour"?"hours":"business days");
            } else {
                $output[] = $row["name"]." - ".$row["start"]."-".$row["end"]." ".($row["unit"]=="hour"?"hours":"business days");
            }
        }
        return $output;
    }

    private function getBonus($id, $bonusTypeID) {
        $row = DB("SELECT * FROM casinos__bonuses WHERE casino_id = ".$id." AND bonus_type_id = ".$bonusTypeID)->toRow();
        if(empty($row)) return;
        $object = new CasinoBonus();
        $object->amount = $row["amount"];
        $object->min_deposit = $row["minimum_deposit"];
        $object->wagering = $row["wagering"];
        $object->games_allowed = $row["games"];
        $object->code = $row["codes"];
        return $object;
    }

    private function appendCountryInfo(Casino $casino, $countryID) {
        $row = DB("
        SELECT
          IF(t3.id IS NOT NULL,1,0) AS currency_supported,
          IF(t4.id IS NOT NULL,1,0) AS country_supported,
          IF(t6.id IS NOT NULL,1,0) AS language_supported
        FROM countries AS t1
        INNER JOIN currencies AS t2 ON t1.currency_id = t2.id
        LEFT JOIN casinos__currencies AS t3 ON t3.casino_id = ".$casino->id." AND t2.id = t3.currency_id
        LEFT JOIN casinos__countries_allowed AS t4 ON t4.casino_id = ".$casino->id." AND t1.id = t4.country_id
        LEFT JOIN countries__languages AS t5 ON t1.id = t5.country_id
        LEFT JOIN casinos__languages AS t6 ON t6.casino_id = ".$casino->id." AND t6.language_id = t5.language_id
        WHERE t1.id = ".$countryID."
        GROUP BY t1.id
        ")->toRow();
        $casino->is_country_accepted = $row["country_supported"];
        $casino->is_currency_accepted = $row["currency_supported"];
        $casino->is_language_accepted = $row["language_supported"];
    }

    public function getResult() {
        return $this->result;
    }
}