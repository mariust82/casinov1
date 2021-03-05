<?php
require_once("entities/Casino.php");
require_once("entities/CasinoBonus.php");
require_once 'entities/FullWelcomePackage.php';
require_once 'entities/MatchBonus.php';
require_once 'application/models/CasinoScore.php';

class CasinoInfo
{
    private $result;

    public function __construct($id, $countryId)
    {
        $this->setResult($id, $countryId);
    }
    
    public function getCasinoScore($casinoID)
    {
        return SQL("SELECT SUM(value) / COUNT(value) AS average FROM casinos__ratings WHERE casino_id = {$casinoID}")->toValue();
    }
    public function getUserScore($casinoID, $ip)
    {
        return  SQL("SELECT value FROM casinos__ratings WHERE ip = :ip AND casino_id = {$casinoID}", array(":ip"=>$ip))->toValue();
    }


    private function setResult($id, $countryId)
    {
        $resultSet = SQL("
        SELECT t1.*,
         t4.name AS status, 
         (t1.rating_total/t1.rating_votes) AS average_rating,
          t2.name AS affiliate_program,
          IF(t1.tc_link<>'',1,0) AS is_tc_link,
          t5.value AS note
        FROM casinos AS t1
        LEFT JOIN affiliate_programs AS t2 ON t1.affiliate_program_id = t2.id
        LEFT JOIN casinos__play_versions AS t3 ON t1.id = t3.casino_id AND t3.play_version_id = 2
        LEFT JOIN casinos__notes AS t5 ON t1.id = t5.casino_id AND t5.language_id = 1
        LEFT JOIN casino_statuses AS t4 ON t1.status_id = t4.id
        WHERE t1.id=:id", array(":id"=>$id));
        $output = null;
        while ($row = $resultSet->toRow()) {
            $output = new Casino();
            $output->id = $row["id"];
            $output->name = $row["name"];
            $output->code = $row["code"];
            $output->rating = ceil($row["average_rating"]);
            $output->rating_votes = $row["rating_votes"];
            $output->live_dealers = $this->getAllLiveGameTypes($row["id"]);
            $output->is_available_in_site = $this->getIsAvailableInSite($output->live_dealers);
            $output->is_live_chat =  $row["is_live_chat"];
            $output->date_established = $row["date_established"];
            $output->affiliate_program = $row["affiliate_program"];
            $output->withdrawal_minimum = $row["withdraw_minimum"];
            $output->status = $row["status"];
            $output->is_tc_link = $row["is_tc_link"];
            $output->logo_big = $this->getCasinoLogo($output->code = $row["code"], "124x82");
            $output->logo_small = $this->getCasinoLogo($output->code = $row["code"], "85x56");
            $output->note = $row["note"];
            $output->score_class = $this->getScoreClass($output->rating); // score class for casino rating
            $output->deposit_minimum = $row["deposit_minimum"];
        }
        if (!$output) {
            return;
        }

        $casino_score = new CasinoScore();
        $votes = $this->getUserVotes($output->id);
        $output->user_votes = $casino_score->setVotesByType($votes);

        // detect primary currencies & append to withdrawal minimum
        $primaryCurrencies = implode("/", $this->getPrimaryCurrencies($output->id));
        $output->withdrawal_minimum = !empty($output->withdrawal_minimum) ? $primaryCurrencies.$output->withdrawal_minimum : 0;
        $output->deposit_minimum = !empty($output->deposit_minimum) ? $primaryCurrencies.$output->deposit_minimum : 0;

        // append softwares
        $output->softwares = $this->getDerivedData("game_manufacturers", "game_manufacturer_id", $output->id, "name", "is_primary DESC,t1.id DESC");
        $output->languages = $this->getDerivedData("languages", "language_id", $output->id);
        $output->currencies = $this->getDerivedData("currencies", "currency_id", $output->id, "code"); // should be code
        $output->emails = $this->getDerivedData("emails", "", $output->id);
        $output->phones = $this->getDerivedData("phones", "", $output->id);
        $output->licenses = $this->getDerivedData("licenses", "license_id", $output->id);
        $output->certifiers = $this->getDerivedData("certifications", "certification_id", $output->id);
        $output->withdrawal_limits = $this->getWithdrawLimits($output->id, $primaryCurrencies);
        $output->is_mobile = $this->isCasinoMobile($output->id);
        $output->withdrawal_timeframes = $this->getWithdrawTimeframes($output->id);
        $output->bonus_first_deposit = $this->getBonus($output->id, array("First Deposit Bonus"));
        $output->bonus_free = !empty($output->bonus_first_deposit) ? $this->getBonus($output->id, array("Free Spins","No Deposit Bonus","Free Play","Bonus Spins")) : null ;
        // $output->bonus_type_Abbreviation = $this->getAbbreviation($output->bonus_free);

        $output->welcome_package = !empty($output->bonus_first_deposit) ? $this->getWelcomePackage($output->id) : [];
        $output->match_bonuses = $this->getMatchBonuses($output->id) ;

        $output->casino_deposit_methods =  $this->getCasinoDepositMethods($output->id);
        $output->casino_game_types = $this->getGameTypes($output->id);
        $this->appendCountryInfo($output, $countryId);
        $this->getCasinoDepositMethods($output->id);
        $this->result = $output;
    }
    
    private function isCasinoMobile($id) {
        $res = SQL("SELECT COUNT(id) FROM `casinos__play_versions` WHERE casino_id = {$id} AND play_version_id = 4")->toValue();
        return $res > 0 ? TRUE : FALSE;
    }

    private function getAllLiveGameTypes($id)
    {
        $query = "SELECT t1.name FROM game_types AS t1
        INNER JOIN casinos__game_types AS t2 ON t1.id = t2.game_type_id
        WHERE t2.is_live = 1 AND t2.casino_id = ".$id;

        $results = SQL($query)->toColumn();
        if (empty($results)) {
            return null;
        } else {
            return $results;
        }
    }

    private function getUserVotes($casino_id){
        return SQL("SELECT value from casinos__ratings WHERE casino_id = :casino_id and status != 3", array(":casino_id" => $casino_id));
    }

    private function getIsAvailableInSite($data)
    {
        if (empty($data)) {
            return null;
        }

        $in_site = ["Roulette","Blackjack","Baccarat","Craps"];
        $available = [];

        foreach ($data as $type) {
            $available[$type] = in_array($type, $in_site);
        }

        return $available;
    }
   
    private function getPrimaryCurrencies($id)
    {
        return SQL("
                SELECT
                t2.symbol
                FROM casinos__currencies AS t1
                INNER JOIN currencies AS t2 ON t1.currency_id = t2.id
                WHERE t1.casino_id = ".$id." AND t1.is_primary = 1
            ")->toColumn();
    }

    private function getDerivedData($entity, $linkingColumn, $id, $columnName="name", $order="")
    {
        if ($linkingColumn) {
            $query = "
                SELECT
                t2.".$columnName."
                FROM casinos__".$entity." AS t1
                INNER JOIN ".$entity." AS t2 ON t1.".$linkingColumn." = t2.id
                WHERE t1.casino_id = ".$id."
            ";
        } else {
            $query = "
                SELECT value 
                FROM casinos__".$entity." 
                WHERE casino_id = ".$id."
            ";
        }
        
        if ($order != '') {
            $query .= " ORDER BY ".$order;
        }
        return SQL($query)->toColumn();
    }

    private function getBankingMethodData($entity, $id)
    {
        return SQL("
            SELECT
            t2.name
            FROM casinos__".$entity." AS t1
            INNER JOIN banking_methods AS t2 ON t1.banking_method_id = t2.id
            WHERE t1.casino_id = ".$id."
        ")->toColumn();
    }

    private function getWithdrawLimits($id, $currencies)
    {
        $output = array();
        $resultSet = SQL("SELECT * FROM casinos__withdraw_maximums WHERE casino_id = ".$id);
        while ($row = $resultSet->toRow()) {
            if (!$row["unit"]) {
                $output[] = "none";
            } else {
                $output[] = $currencies.$row["amount"]." per ".$row["unit"];
            }
        }
        return $output;
    }

    private function getWithdrawTimeframes($id)
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
                $output[] = $row["name"]." - immediate";
            } elseif ($row["end"]==1) {
                $output[] = $row["name"]." - up to 1 ".($row["unit"]=="hour"?"hour":"business day");
            } elseif ($row["start"]==0) {
                $output[] = $row["name"]." - up to ".$row["end"]." ".($row["unit"]=="hour"?"hours":"business days");
            } else {
                $output[] = $row["name"]." - ".$row["start"]."-".$row["end"]." ".($row["unit"]=="hour"?"hours":"business days");
            }
        }
        return $output;
    }

    private function getBonus($id, $bonusTypes)
    {
        $query = "
        SELECT t1.*, t2.name FROM casinos__bonuses AS t1
        INNER JOIN bonus_types AS t2 ON t1.bonus_type_id = t2.id
        WHERE t1.casino_id = ".$id." AND t2.name IN ('".implode("','", $bonusTypes)."')";
        $row = SQL($query)->toRow();
        if (empty($row)) {
            return;
        }

        if (strtolower($row['amount']) == 'none' || strlen($row['amount'])==0) {
            return null;
        }

        $object = new CasinoBonus();
        $object->amount = $row["amount"];
        $object->min_deposit = $row["deposit_minimum"];
        $object->wagering = $row["wagering"];
        $object->games_allowed = $row["games"];
        $object->code = $row["codes"];
        $object->type = $row["name"];

        return $object;
    }

    private function appendCountryInfo(Casino $casino, $countryID)
    {
        $row = SQL("
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

    public function getResult()
    {
        return $this->result;
    }

    public function isCountryAccepted($casinoID, $countryID)
    {
        return SQL("select casino_id from casinos__countries_allowed where casino_id=:casino_id and country_id=:country_id", [
            ":casino_id"=>$casinoID,
            ":country_id"=>$countryID
        ])->toValue();
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

    public function getScoreClass($score)
    {
        if ($score == 0) {
            return 'No score';
        } elseif ($score >= 1 && $score < 3) {
            return  'Terrible';
        } elseif ($score >= 3 && $score < 5) {
            return  'Poor';
        } elseif ($score >= 5 && $score < 7) {
            return  'Good';
        } elseif ($score >= 7 && $score < 9) {
            return  'Very good';
        } elseif ($score >= 9 && $score <= 10) {
            return 'Excellent';
        }
    }

    private function getAbbreviation($casinos)
    {
        $abbr = array();
        $index = 0;
        foreach ($casinos as $casino) {
            $abbr[$index] = null;
            if ($casino->bonus_free) {
                $name = $casino->bonus_free->type;

                $words = explode(" ", $name);
                foreach ($words as $word) {
                    $abbr[$index] .= $word[0];
                }
            }
            $index++;
        }
        return $abbr;
    }

    public function getWelcomePackage($casino_id)
    {
        $q = "
                 SELECT
            t1.*, t2.name as bonus_type_name
            FROM casinos__bonuses AS t1 INNER JOIN
            bonus_types as t2 ON t1.bonus_type_id = t2.id
            WHERE t2.name IN ('First Deposit Bonus','No Deposit Bonus' ,'Welcome Package' , 'Free Spins') AND t1.casino_id = ".$casino_id."
             ORDER BY  CASE
                    WHEN t2.name  = 'Free Spins'  THEN 0
                     WHEN t2.name  = 'No Deposit Bonus'  THEN 1
                     WHEN t2.name = 'First Deposit Bonus'  THEN 2
                     WHEN t2.name = 'Welcome Package' THEN 3
                     END ASC
        ";
        $w_packages = SQL($q)->toList();

        if (empty($w_packages)) {
            return [];
        }

        $w_packages_data = [];
        foreach ($w_packages as  $wp_data) {
            $full_welcome_package = new FullWelcomePackage();
            $full_welcome_package->valid_on =$wp_data['availability'];
            $full_welcome_package->bonus = $wp_data['amount'];
            $full_welcome_package->min_deposit = $wp_data['deposit_minimum'];
            $full_welcome_package->wagering = $wp_data['wagering'];
            $full_welcome_package->games = $wp_data['games'];
            $full_welcome_package->bonus_codes = $wp_data['codes'];

            switch ($wp_data['bonus_type_name']) {
                case 'First Deposit Bonus':
                    $full_welcome_package->valid_on  = '1st Deposit';
                    if (strtolower($full_welcome_package->bonus) == 'none' || strlen($full_welcome_package->bonus)==0) {
                        return [];
                    }
                break;

                case 'No Deposit Bonus':
                    $full_welcome_package->valid_on  = 'On sign-up';
                    $full_welcome_package->min_deposit = 'Free';
                    break;
                case 'Free Spins':
                    $full_welcome_package->valid_on  = 'On sign-up';
                    $full_welcome_package->min_deposit = 'Free';
                    if (strpos($full_welcome_package->bonus, 'FS') === false) {
                        $full_welcome_package->bonus = $full_welcome_package->bonus .' FS';
                    }
                break;
            }

            $w_packages_data[] = $full_welcome_package;
        }
        return  $w_packages_data;
    }

    public function getMatchBonuses($casino_id)
    {
        $q = "
                 SELECT
            t1.*, t2.name as bonus_type_name
            FROM casinos__bonuses AS t1 
            INNER JOIN bonus_types as t2 ON t1.bonus_type_id = t2.id
            WHERE t2.name IN ('Match Bonus') AND t1.casino_id = ".$casino_id."
        ";
        $match_bonuses = SQL($q)->toList();

        if (empty($match_bonuses)) {
            return [];
        }

        $match_bonuses_data = [];
        foreach ($match_bonuses as  $m_bonus) {
            $match_bonus_package = new MatchBonus();
            $match_bonus_package->valid_on =$m_bonus['availability'];
            $match_bonus_package->bonus = $m_bonus['amount'];
            $match_bonus_package->min_deposit = $m_bonus['deposit_minimum'];
            $match_bonus_package->wagering = $m_bonus['wagering'];
            $match_bonus_package->games = $m_bonus['games'];
            $match_bonus_package->bonus_codes = $m_bonus['codes'];

            $match_bonuses_data[] = $match_bonus_package;
        }
        return  $match_bonuses_data;
    }

    public function getGameTypes($casinoId)
    {
        $q =" SELECT
            t2.name
            FROM casinos__game_types AS t1
            INNER JOIN game_types AS t2 ON t1.	game_type_id = t2.id
            WHERE t1.casino_id =  $casinoId";

        $data = SQL($q)->toList();
        return $data;
    }

    public function getCasinoDepositMethods($casino_id)
    {
        $deposit_methods =  $this->getBankingMethodData("deposit_methods", $casino_id);
        $withdraw_methods =   $this->getBankingMethodData("withdraw_methods", $casino_id);
        $casino_deposit_methods = array_merge($deposit_methods, $withdraw_methods);

        $casino_deposit_methods_data = [];
        foreach ($casino_deposit_methods as $key => $value) {
            $casino_deposit_methods_data[$value]['deposit_methods'] = in_array($value, $deposit_methods);
            $casino_deposit_methods_data[$value]['withdraw_methods'] = in_array($value, $withdraw_methods);
            $casino_deposit_methods_data[$value]['logo'] = $value;
        }
        return $casino_deposit_methods_data;
    }
}
