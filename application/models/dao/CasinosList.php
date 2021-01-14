<?php
require_once("entities/Casino.php");
require_once("entities/CasinoBonus.php");
require_once("queries/CasinosListQuery.php");
require_once("application/helpers/CasinoHelper.php");

class CasinosList
{
    const LIMIT = 100;
    private $filter;
    private $helper;

    public function __construct(CasinoFilter $filter)
    {
        $this->filter = $filter;
        $this->helper = new Casinohelper();
    }

    public function getResults($sortBy, $page = 1, $limit = self::LIMIT, $offset = "")
    {
        $output = array();
        $fields = array( "DISTINCT  t1.id", "t1.deposit_minimum", "t1.status_id", "t1.name", "t1.code", "(t1.rating_total/t1.rating_votes) AS average_rating", "t1.date_established", "IF(t2.casino_id IS NOT NULL, 1, 0) AS is_country_supported","IF(t15.id IS NOT NULL,1,0) AS currency_supported", "IF(t1.tc_link<>'', 1, 0) AS is_tc_link");

        $queryGenerator = new CasinosListQuery(
            $this->filter,
            $fields,
            $sortBy,
            $limit,
            $offset
        );
        $query = $queryGenerator->getQuery();
        $resultSet = SQL($query);

        while ($row = $resultSet->toRow()) {
            $object = new Casino();
            $object->id = $row["id"];
            $object->name = $row["name"];
            $object->code = $row["code"];
            $object->rating = ceil($row["average_rating"]);
            $object->is_country_accepted = $row["is_country_supported"];
            $object->date_established = $row["date_established"];
            $object->status = $row["status_id"];
            $object->deposit_minimum = $row["deposit_minimum"];
            $object->is_tc_link = $row["is_tc_link"];
            $object->new = $this->helper->isCasinoNew($row["date_established"]);
            $object->score_class = $this->helper->getScoreClass($object->rating);
            $object->casino_game_types = $this->getGameTypes($object->id);
            $object->comments = $this->countCasinoComments($object->id);
            $object->casino_deposit_methods =  $this->getCasinoDepositMethods($object->id);
            $object->is_currency_accepted = $row['currency_supported'];
            $object->currencies = $this->getPrimaryCurrencySymbols($row["id"]);
            if ($this->filter->getBankingMethod()) {
                $object->deposit_methods = $row["has_dm"];
                $object->withdraw_methods = $row["has_wm"];
            }
            if ($this->filter->getCasinoLabel() == 'Fast Payout') {
                $object->withdrawal_timeframes = $row['end'] == 0 ? "Instant" : "Up to ".$row['end']." hours";
            }
            $output[$row["id"]] = $object;
        }
        if (empty($output)) {
            return array();
        }

        // append softwares
        $query = "
        SELECT t1.casino_id, t2.name 
        FROM casinos__game_manufacturers AS t1
        INNER JOIN game_manufacturers AS t2 ON t1.game_manufacturer_id = t2.id
        WHERE t1.casino_id IN (".implode(",", array_keys($output)).") ORDER BY t1.is_primary DESC;
        ";
        $resultSet = SQL($query);
        while ($row=$resultSet->toRow()) {
            $output[$row["casino_id"]]->softwares[] = $row["name"];
        }
        // append bonuses
        $query = "
        SELECT t1.casino_id, t1.codes, t1.amount, t1.wagering, t1.deposit_minimum, t1.games, t2.name , t1.bonus_type_id
        FROM casinos__bonuses AS t1
        INNER JOIN bonus_types AS t2 ON t1.bonus_type_id = t2.id
        WHERE t1.casino_id IN (".implode(",", array_keys($output)).") AND t2.name IN ('No Deposit Bonus','First Deposit Bonus','Free Spins','Free Play','Bonus Spins')
        ";
        $resultSet = SQL($query);
        while ($row = $resultSet->toRow()) {
            $bonus = new CasinoBonus();
            $bonus->amount = ($row["name"]=="Free Spins"?trim(str_replace("FS", "", $row["amount"])):$row["amount"]);
            $bonus->min_deposit = $row["deposit_minimum"];
            if ($row["wagering"] == '') {
                $row["wagering"] = 0;
            }
            $bonus->wagering = $row["wagering"];
            $bonus->games_allowed = $row["games"];
            $bonus->code = $row["codes"];
            $bonus->type = $row["name"];
            if ($row["name"]=="No Deposit Bonus" || $row["name"]=="Free Spins" || $row["name"]=="Free Play" || $row["name"]=="Bonus Spins") {
                $output[$row["casino_id"]]->bonus_free = $bonus;
                $output[$row["casino_id"]]->isFree = 1;
            } else {
                $output[$row["casino_id"]]->bonus_first_deposit = $bonus;
                $output[$row["casino_id"]]->isFree = 0;
            }
        }

        foreach ($output as $arg) {
            if (sizeof($arg->softwares)>1) {
                $arg->all_softwares = $this->helper->get_string($arg->softwares);
            }
        }


        return array_values($output);
    }

    private function getGameTypes($casinoId)
    {
        $q =" SELECT
            t2.name
            FROM casinos__game_types AS t1
            INNER JOIN game_types AS t2 ON t1.	game_type_id = t2.id
            WHERE t1.casino_id =  $casinoId";

        $data = SQL($q)->toList();
        return $data;
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
    private function getPrimaryCurrencySymbols($id)
    {
        return SQL("
                SELECT
                GROUP_CONCAT(IF(t2.symbol<>'',  t2.symbol, t2.code) SEPARATOR '/')
                FROM casinos__currencies AS t1
                INNER JOIN currencies AS t2 ON t1.currency_id = t2.id
                WHERE t1.casino_id = ".$id." AND t1.is_primary = 1 AND t2.is_crypto is false")
            ->toValue();
    }
    
    private function getCasinoDepositMethods($casino_id)
    {
        $deposit_methods =  $this->getBankingMethodData("deposit_methods", $casino_id);
        $withdraw_methods =   $this->getBankingMethodData("withdraw_methods", $casino_id);
        $casino_deposit_methods = array_merge($deposit_methods, $withdraw_methods);

        $casino_deposit_methods_data = [];
        foreach ($casino_deposit_methods as $key => $value) {
            $casino_deposit_methods_data[$value]['deposit_methods'] = in_array($value, $deposit_methods);
            $casino_deposit_methods_data[$value]['withdraw_methods'] = in_array($value, $withdraw_methods);
            $casino_deposit_methods_data[$value]['logo'] = '/public/sync/banking_method_light/68x39/'.strtolower(str_replace(' ', '_', $value)).'.png';
        }
        return $casino_deposit_methods_data;
    }

    public function getTotal()
    {
        // build query
        if ($this->filter->getPlayVersion() == "Live Dealer") {
            $fields = "COUNT(DISTINCT t1.id) AS nr";
        } else {
            $fields = "COUNT(DISTINCT t1.id) AS nr";
        }
        $queryGenerator = new CasinosListQuery($this->filter, array($fields), null, 0, '', false);
        $query = $queryGenerator->getQuery();
        return SQL($query)->toValue();
    }
    
    private function countCasinoComments($id) {
        return SQL("SELECT COUNT(id) FROM `casinos__reviews` WHERE casino_id = {$id} AND status != 3")->toValue();
    }

    public function getManufacturers($sortBy, $limit = null, $offset = "") {
        $output = array();
        $fields = array( "t1.id" , "t1.status_id", "t1.name", "t1.code", "(t1.rating_total/t1.rating_votes) AS average_rating", "t1.date_established", "IF(t2.casino_id IS NOT NULL, 1, 0) AS is_country_supported", "IF(t1.tc_link<>'', 1, 0) AS is_tc_link");

        $queryGenerator = new CasinosListQuery(
            $this->filter,
            $fields,
            $sortBy,
            $limit,
            $offset
        );
        $query = $queryGenerator->getQuery();
       // var_dump($query); die;
        $resultSet = SQL($query);
        while ($row = $resultSet->toRow()) {
            $output[] = $row["id"];
        }

        $query = " 
                  SELECT t1.id, t1.name as unit, COUNT(t1.id) AS nr
                  FROM game_manufacturers as t1
                  INNER JOIN casinos__game_manufacturers AS t2 ON t1.id = t2.game_manufacturer_id AND t2.casino_id IN (".implode(",", array_values($output)).")
                  WHERE t1.is_open = 1
                  GROUP by t1.name
                  ORDER By t1.priority DESC";

        return SQL($query)->toList();
    }

    public function getTopPicks($country) {
        $resultSet = SQL("SELECT t2.*, IF(t3.casino_id IS NOT NULL, 1, 0) AS is_country_supported FROM `top_picks` AS `t1` 
        INNER JOIN `casinos` AS `t2` ON (`t1`.`n_c_id` = `t2`.`id`) 
        LEFT JOIN casinos__countries_allowed AS t3 ON (t2.id = t3.casino_id) AND t3.country_id = {$country}
        WHERE `t1`.`date`='" . date("Y-m-01") . "'");

        while ($row = $resultSet->toRow()) {
            $object = new Casino();
            $object->name = $row["name"];
            $object->is_country_accepted = $row["is_country_supported"];
            $object->logo_small = $this->helper->getCasinoLogo($object->code = $row["code"], "85x56");//   $object->logo_small = "/public/sync/casino_logo_light/85x56/".strtolower(str_replace(" ", "_", $object->code)).".png";
            $output[$row["id"]] = $object;
        }
        if (empty($output)) {
            return array();
        }

        // append bonuses
        $query = "
        SELECT t1.casino_id, t1.codes, t1.amount, t1.wagering, t1.deposit_minimum, t1.games, t2.name , t1.bonus_type_id
        FROM casinos__bonuses AS t1
        INNER JOIN bonus_types AS t2 ON t1.bonus_type_id = t2.id
        WHERE t1.casino_id IN (".implode(",", array_keys($output)).") AND t2.name IN ('No Deposit Bonus','First Deposit Bonus','Free Spins','Free Play','Bonus Spins')
        ";
        $resultSet = SQL($query);
        while ($row = $resultSet->toRow()) {
            $bonus = new CasinoBonus();
            $bonus->amount = $row["amount"];
            $bonus->min_deposit = $row["deposit_minimum"];
            if ($row["wagering"] == '') {
                $row["wagering"] = 0;
            }
            $bonus->wagering = $row["wagering"];
            $bonus->games_allowed = $row["games"];
            $bonus->code = $row["codes"];
            $bonus->type = $row["name"];
            if ($row["name"]=="No Deposit Bonus" || $row["name"]=="Free Spins" || $row["name"]=="Free Play" || $row["name"]=="Bonus Spins") {
                $output[$row["casino_id"]]->bonus_free = $bonus;
            } else {
                $output[$row["casino_id"]]->bonus_first_deposit = $bonus;
            }
        }

        return array_values($output);
    }
    public function getAllGameTypes() {
        $q ="SELECT t1.name FROM game_types AS t1";
        return SQL($q)->toList();
    }
}
