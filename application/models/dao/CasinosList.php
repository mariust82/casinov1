<?php
require_once("entities/Casino.php");
require_once("entities/CasinoBonus.php");
require_once("queries/CasinosListQuery.php");
require_once("queries/CasinosTotalsQuery.php");
require_once("application/helpers/CasinoHelper.php");
require_once("application/models/dao/CasinoInfo.php");

class CasinosList
{
    const LIMIT = 100;
    protected $filter;
    protected $helper;

    public function __construct(CasinoFilter $filter)
    {
        $this->filter = $filter;
        $this->helper = new Casinohelper();
    }

    public function getResults($sortBy, $page = 1, int $limit = self::LIMIT, int $offset = 0)
    {
        $output = array();
        $fields = array(
            "t1.id",
            "t1.withdraw_minimum",
            "t1.deposit_minimum",
            "t1.status_id",
            "cs.name AS status",
            "t1.name",
            "t1.code",
            "t1.rating_votes",
            "t1.date_established",
            "IF(t1.tc_link<>'', 1, 0) AS is_tc_link");

        $queryGenerator = new CasinosListQuery(
            $this->filter,
            $fields,
            $sortBy,
            $limit,
            $offset
        );
        $resultSet = SQL($queryGenerator->getQuery(), $queryGenerator->getParameters());

        while ($row = $resultSet->toRow()) {
            $object = new Casino();
            $object->id = $row["id"];
            $object->name = $row["name"];
            $object->code = $row["code"];
            $object->withdrawal_minimum = $row['withdraw_minimum'];
            $object->date_established = $row["date_established"];
            $object->status = $row["status"];
            $object->deposit_minimum = $row["deposit_minimum"];
            $object->is_tc_link = $row["is_tc_link"];
            $object->new = $this->helper->isCasinoNew($row["date_established"]);
            $object->rating = 0;
            $object->rating_votes = $row["rating_votes"];
            $object->score_class = $this->helper->getScoreClass($object->rating);
            if ($this->filter->getCasinoLabel() == 'Fast Payout') {
                $object->withdrawal_timeframes = $row['end'] == 0 ? "Instant" : "Up to " . $row['end'] . " hours";
            }
            $output[$row["id"]] = $object;
        }
        if (empty($output)) {
            return array();
        }
        $allowedIds = implode(",", array_keys($output));
        if ($this->filter->getBankingMethod()) {
            $this->appendBankingMethodSupported($output, $allowedIds);
        }
        $this->appendAcceptedCountry($output, $allowedIds);
        $this->appendAcceptedCurrency($output, $allowedIds);
        $this->appendAcceptedLanguage($output, $allowedIds);
        $this->appendPrimaryCurrencySymbols($output, $allowedIds);
        $this->appendCountCasinoComments($output, $allowedIds);
        $this->appendGameTypes($output, $allowedIds);
        $this->appendSoftwares($output, $allowedIds);
        $this->appendBonuses($output, $allowedIds);
        $this->appendBankingMethods($output, $allowedIds);
        $this->appendRating($output, $allowedIds);

        array_walk($output, function (Casino &$casino) {
            $casino->all_softwares = $this->helper->get_string($casino->softwares);
        });

        return array_values($output);
    }

    protected function appendAcceptedCountry(array &$output, string $allowedIds): void
    {
        // append if country currency is accepted for casinos
        $resultSet = SQL("
        SELECT
        casino_id
        FROM casinos__countries_allowed
        WHERE casino_id IN (" . $allowedIds . ") AND country_id = " . $this->filter->getDetectedCountry()->id . "
        ");
        while ($row = $resultSet->toRow()) {
            $output[$row["casino_id"]]->is_country_accepted = true;
        }
    }

    protected function appendAcceptedCurrency(array &$output, string $allowedIds): void
    {
        // append if country currency is accepted for casinos
        $resultSet = SQL("
        SELECT
        t1.casino_id
        FROM casinos__currencies AS t1
        INNER JOIN currencies AS t2 ON t1.currency_id = t2.id
        WHERE casino_id IN (" . $allowedIds . ") AND t2.code = '" . $this->filter->getDetectedCountry()->currency . "'
        GROUP BY t1.casino_id
        ");
        while ($row = $resultSet->toRow()) {
            $output[$row["casino_id"]]->is_currency_accepted = true;
        }
    }

    protected function appendAcceptedLanguage(array &$output, string $allowedIds): void
    {
        $resultSet = SQL("
        SELECT
        t1.casino_id
        FROM casinos__languages AS t1
        INNER JOIN languages AS t2 ON t1.language_id = t2.id
        WHERE t1.casino_id IN (" . $allowedIds . ") AND t2.name IN ('" . implode("', '", $this->filter->getDetectedCountry()->languages) . "')
        GROUP BY t1.casino_id
        ");
        while ($row = $resultSet->toRow()) {
            $output[$row["casino_id"]]->is_language_accepted = true;
        }
    }

    protected function appendBankingMethodSupported(array &$output, string $allowedIds): void
    {
        $correspondences = ["casinos__deposit_methods" => "deposit_methods", "casinos__withdraw_methods" => "withdraw_methods"];
        foreach ($correspondences as $tableName => $fieldName) {
            $resultSet = SQL("SELECT casino_id FROM " . $tableName . " WHERE casino_id IN (" . $allowedIds . ") AND banking_method_id = " . $this->filter->getBankingMethod());
            while ($row = $resultSet->toRow()) {
                $output[$row["casino_id"]]->$fieldName = 1;
            }
        }
    }

    /**
     * Append primary currency symbols which belongs to casino.
     *
     * @param array $output
     * @param string $allowedIds
     *
     * @return void
     *
     * @throws \Lucinda\SQL\ConnectionException
     * @throws \Lucinda\SQL\StatementException
     */
    protected function appendPrimaryCurrencySymbols(array &$output, string $allowedIds): void
    {
        $result = SQL(
            "SELECT t1.casino_id, GROUP_CONCAT(IF(t2.symbol<>'',  t2.symbol, t2.code) SEPARATOR '/') AS symbol
                FROM casinos__currencies AS t1
                INNER JOIN currencies AS t2 ON t1.currency_id = t2.id
            WHERE t1.is_primary = 1 AND t2.is_crypto IS FALSE AND t1.casino_id IN (" . $allowedIds . ") 
            GROUP BY t1.casino_id"
        );

        while ($row = $result->toRow()) {
            $object = $output[$row["casino_id"]];
            $output[$row["casino_id"]]->currencies = $row["symbol"];
            $output[$row["casino_id"]]->deposit_minimum = ($object->deposit_minimum ? $row["symbol"] . $object->deposit_minimum : "");
            $output[$row["casino_id"]]->withdrawal_minimum = ($object->withdrawal_minimum ? $row["symbol"] . $object->withdrawal_minimum : "");
        }
    }

    /**
     * Append count casino comments.
     *
     * @param array $output
     * @param string $allowedIds
     *
     * @return void
     *
     * @throws \Lucinda\SQL\ConnectionException
     * @throws \Lucinda\SQL\StatementException
     */
    protected function appendCountCasinoComments(array &$output, string $allowedIds): void
    {
        $result = SQL(
            "SELECT casino_id, COUNT(id) AS ctn FROM casinos__reviews 
                WHERE casino_id IN (" . $allowedIds . ") AND status != 3
                GROUP BY casino_id"
        );

        while ($row = $result->toRow()) {
            $output[$row["casino_id"]]->comments = $row["ctn"];
        }
    }

    /**
     * Append casinos rating.
     *
     * @param array $output
     * @param string $allowedIds
     *
     * @throws \Lucinda\SQL\ConnectionException
     * @throws \Lucinda\SQL\StatementException
     */
    protected function appendRating(array &$output, string $allowedIds): void
    {
        // append average rating
        $query = "SELECT id, (rating_total/rating_votes) AS average_rating
            FROM casinos WHERE id IN (" . $allowedIds . ");";
        $resultSet = SQL($query);
        while ($row = $resultSet->toRow()) {
            $output[$row["id"]]->rating = ceil($row["average_rating"]);
        }
    }

    public function getBonusCasinosPopup($id)
    {
        $query = "
        SELECT t1.casino_id, t1.codes, t1.amount, t1.wagering, t1.deposit_minimum, t1.games, t2.name , t1.bonus_type_id
        FROM casinos__bonuses AS t1
        INNER JOIN bonus_types AS t2 ON t1.bonus_type_id = t2.id
        WHERE t1.casino_id = {$id} AND t2.name IN ('No Deposit Bonus','First Deposit Bonus','Free Spins','Free Play','Bonus Spins')
        ";
        $casino = new Casino();
        $casino->id = $id;
        $resultSet = SQL($query);
        while ($row = $resultSet->toRow()) {
            $bonus = new CasinoBonus();
            $bonus->amount = ($row["name"] == "Free Spins" ? trim(str_replace("FS", "", $row["amount"])) : $row["amount"]);
            $bonus->min_deposit = $row["deposit_minimum"];
            if ($row["wagering"] == '') {
                $row["wagering"] = 0;
            }
            $bonus->wagering = $row["wagering"];
            $bonus->games_allowed = $row["games"];
            $bonus->code = $row["codes"];
            $bonus->type = $row["name"];
            if ($row["name"] == "No Deposit Bonus" || $row["name"] == "Free Spins" || $row["name"] == "Free Play" || $row["name"] == "Bonus Spins") {
                $casino->bonus_free = $bonus;
            } else {
                $casino->bonus_first_deposit = $bonus;
            }
        }
        return $casino;
    }

    /**
     * Append count casino comments.
     *
     * @param array $output
     * @param string $allowedIds
     *
     * @return void
     *
     * @throws \Lucinda\SQL\ConnectionException
     * @throws \Lucinda\SQL\StatementException
     */
    protected function appendGameTypes(array &$output, string $allowedIds): void
    {
        $result = SQL(
            "SELECT t1.casino_id, t2.name FROM casinos__game_types AS t1
                INNER JOIN game_types AS t2 ON t1.	game_type_id = t2.id
            WHERE t1.casino_id IN (" . $allowedIds . ")"
        );

        while ($row = $result->toRow()) {
            $output[$row["casino_id"]]->casino_game_types[] = ["name" => $row["name"]];
        }
    }

    protected function appendSoftwares(array &$output, $allowedIds)
    {
        // append softwares
        $query = "
        SELECT t1.casino_id, t2.name
        FROM casinos__game_manufacturers AS t1
        INNER JOIN game_manufacturers AS t2 ON t1.game_manufacturer_id = t2.id
        WHERE t1.casino_id IN (" . $allowedIds . ") ORDER BY t1.is_primary DESC;
        ";
        $resultSet = SQL($query);
        while ($row = $resultSet->toRow()) {
            $output[$row["casino_id"]]->softwares[] = $row["name"];
        }
    }

    protected function appendBonuses(array &$output, $allowedIds)
    {
        // append bonuses
        $query = "
        SELECT t1.casino_id, t1.codes, t1.amount, t1.wagering, t1.deposit_minimum, t1.games, t2.name , t1.bonus_type_id
        FROM casinos__bonuses AS t1
        INNER JOIN bonus_types AS t2 ON t1.bonus_type_id = t2.id
        WHERE t1.casino_id IN (" . $allowedIds . ") AND t2.name IN ('No Deposit Bonus','First Deposit Bonus','Free Spins','Free Play','Bonus Spins')
        ";
        $resultSet = SQL($query);
        while ($row = $resultSet->toRow()) {
            $bonus = new CasinoBonus();
            $bonus->amount = ($row["name"] == "Free Spins" ? trim(str_replace("FS", "", $row["amount"])) : $row["amount"]);
            $bonus->min_deposit = $row["deposit_minimum"];
            if ($row["wagering"] == '') {
                $row["wagering"] = 0;
            }
            $bonus->wagering = $row["wagering"];
            $bonus->games_allowed = $row["games"];
            $bonus->code = $row["codes"];
            $bonus->type = $row["name"];
            if ($row["name"] == "No Deposit Bonus" || $row["name"] == "Free Spins" || $row["name"] == "Free Play" || $row["name"] == "Bonus Spins") {
                $output[$row["casino_id"]]->bonus_free = $bonus;
                $output[$row["casino_id"]]->isFree = 1;
            } else {
                $output[$row["casino_id"]]->bonus_first_deposit = $bonus;
                $output[$row["casino_id"]]->isFree = 0;
            }
        }
    }

    protected function appendBankingMethods(array &$output, $allowedIds)
    {
        $deposit_methods = $this->getBankingMethodData("deposit_methods", $allowedIds);
        foreach ($deposit_methods as $casinoId => $list) {
            foreach ($list as $bankingMethodName) {
                $output[$casinoId]->casino_deposit_methods[$bankingMethodName] = [
                    'deposit_methods' => true,
                    'withdraw_methods' => false,
                    'logo' => $bankingMethodName
                ];
            }
        }

        $withdraw_methods = $this->getBankingMethodData("withdraw_methods", $allowedIds);
        foreach ($withdraw_methods as $casinoId => $list) {
            foreach ($list as $bankingMethodName) {
                if (isset($output[$casinoId]->casino_deposit_methods[$bankingMethodName])) {
                    $output[$casinoId]->casino_deposit_methods[$bankingMethodName]['withdraw_methods'] = true;
                } else {
                    $output[$casinoId]->casino_deposit_methods[$bankingMethodName] = [
                        'deposit_methods' => false,
                        'withdraw_methods' => true,
                        'logo' => $bankingMethodName
                    ];
                }
            }
        }

    }

    protected function getBankingMethodData($entity, $allowedIds)
    {
        $output = [];
        $resultSet = SQL("
            SELECT
            t1.casino_id, t2.name
            FROM casinos__" . $entity . " AS t1
            INNER JOIN banking_methods AS t2 ON t1.banking_method_id = t2.id
            WHERE t1.casino_id IN (" . $allowedIds . ")
        ");
        while ($row = $resultSet->toRow()) {
            $output[$row["casino_id"]][] = $row["name"];
        }
        return $output;
    }

    public function getTotal()
    {
        $queryGenerator = new CasinosTotalsQuery($this->filter);
        return SQL($queryGenerator->getQuery(), $queryGenerator->getParameters())->toValue();
    }

    public function getBestCasinosByCountry($id, $currency_id, $lang_id, $limit = 5, $offset = 0)
    {
        $output = [];
        $date = date("Y-m-d", strtotime(date("Y-m-d") . " -6 months"));
        $res = SQL("SELECT DISTINCT t1.id, t1.name,t1.tc_link , t1.code, t1.rating_votes,
                    IF(t2.casino_id IS NOT NULL, 1, 0) AS is_country_supported,
                    IF(t15.casino_id IS NOT NULL,1,0) AS currency_supported,
                    IF(t17.casino_id IS NOT NULL,1,0) AS language_accepted,
                    IF(t1.tc_link<>'', 1, 0) AS is_tc_link, t19.id AS complex_case 
                    FROM casinos AS t1 
                    INNER JOIN casino_statuses_extended AS t19 ON t1.status_id = t19.status_id 
                    LEFT OUTER JOIN casinos__currencies AS t15 ON t1.id = t15.casino_id AND t15.currency_id = {$currency_id}
                    LEFT OUTER JOIN casinos__languages AS t17 ON t1.id = t17.casino_id AND t17.language_id = {$lang_id}
                    INNER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id AND t2.country_id = {$id} 
                    LEFT OUTER JOIN casino_statuses AS cs ON t1.status_id = cs.id WHERE t1.is_open = 1 AND t1.status_id IN (0,3)
                    AND t1.date_established <= '{$date}' AND t1.rating_votes >= 10 AND (t1.rating_total/t1.rating_votes) >= 7.5 
                    GROUP BY t1.id ORDER BY (t1.rating_total/t1.rating_votes) DESC, t1.priority DESC, t1.id DESC LIMIT {$limit} OFFSET {$offset}");
        while ($row = $res->toRow()) {
            $object = new Casino();
            $object->id = $row['id'];
            $object->name = $row["name"];
            $object->code = $row["code"];
            $object->rating = 0;
            $object->rating_votes = $row["rating_votes"];
            $object->is_country_accepted = $row["is_country_supported"];
            $object->is_currency_accepted = $row['currency_supported'];
            $object->is_language_accepted = $row['language_accepted'];
            $object->is_tc_link = $row['is_tc_link'];
            $object->tc_link = $row['tc_link'];
            $output[$row["id"]] = $object;
        }
        $allowedIds = implode(",", array_keys($output));
        if (!empty($allowedIds)) {
            $this->appendBonuses($output, $allowedIds);
            $this->appendRating($output, $allowedIds);
        }

        return $output;
    }

    public function getNewestCasinosByCountry($id, $limit = 5, $offset = 0)
    {
        $output = [];
        $date = date("Y-m-d", strtotime(date("Y-m-d") . " -1 year"));
        $res = SQL("SELECT DISTINCT  t1.id, t1.status_id, cs.name AS status, t1.name, t1.code, t1.date_established, IF(t2.casino_id IS NOT NULL, 1, 0) AS is_country_supported, t19.id AS complex_case
                    FROM casinos AS t1
                    INNER JOIN casino_statuses_extended AS t19 ON t1.status_id = t19.status_id
                    LEFT OUTER JOIN casinos__currencies AS t15 ON t1.id = t15.casino_id
                    INNER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id AND t2.country_id = {$id}
                    INNER JOIN casinos__bonuses AS t4 ON t1.id = t4.casino_id AND t4.bonus_type_id IN (3,4,5,6,11)
                    LEFT OUTER JOIN casino_statuses AS cs ON t1.status_id = cs.id
                    WHERE t1.is_open = 1 AND t1.date_established > '{$date}'
                    ORDER BY t1.date_established DESC, t1.priority DESC, t1.id DESC LIMIT {$limit} OFFSET {$offset}");
        while ($row = $res->toRow()) {
            $object = new Casino();
            $object->id = $row['id'];
            $object->name = $row["name"];
            $object->code = $row["code"];
            $object->is_country_accepted = $row["is_country_supported"];
            $output[$row["id"]] = $object;
        }
        $allowedIds = implode(",", array_keys($output));
        if (!empty($allowedIds)) {
            $this->appendBonuses($output, $allowedIds);
        }

        return $output;
    }

    public function countNewestCasinosByCountry($id)
    {
        $date = date("Y-m-d", strtotime(date("Y-m-d") . " -1 year"));
        return SQL("SELECT COUNT(DISTINCT  t1.id) FROM casinos AS t1
                    LEFT OUTER JOIN casinos__currencies AS t15 ON t1.id = t15.casino_id
                    INNER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id AND t2.country_id = {$id}
                    INNER JOIN casinos__bonuses AS t4 ON t1.id = t4.casino_id AND t4.bonus_type_id IN (3,4,5,6,11)
                    LEFT OUTER JOIN casino_statuses AS cs ON t1.status_id = cs.id
                    WHERE t1.is_open = 1 AND t1.date_established > '{$date}'")->toValue();
    }


    public function countBestCasinosByCountry($id)
    {
        $date = date("Y-m-d", strtotime(date("Y-m-d") . " -6 months"));
        return SQL("SELECT COUNT(DISTINCT t1.id) 
                    FROM casinos AS t1 
                    INNER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id AND t2.country_id = {$id} 
                    LEFT OUTER JOIN casino_statuses AS cs ON t1.status_id = cs.id WHERE t1.is_open = 1 AND t1.status_id IN (0,3)
                    AND t1.date_established <= '{$date}' AND t1.rating_votes >= 10 AND (t1.rating_total/t1.rating_votes) >= 7.5")->toValue();
    }

    public function getManufacturers(?int $sortBy = null, ?int $limit = null, ?int $offset = null)
    {
        $output = array();
        $fields = array("t1.id", "t1.status_id", "t1.name", "t1.code", "(t1.rating_total/t1.rating_votes) AS average_rating", "t1.date_established", "IF(t1.tc_link<>'', 1, 0) AS is_tc_link");
        $queryGenerator = new CasinosListQuery(
            $this->filter,
            $fields,
            $sortBy,
            $limit,
            $offset
        );
        $query = $queryGenerator->getQuery();
        $resultSet = SQL($query, $queryGenerator->getParameters());
        while ($row = $resultSet->toRow()) {
            $output[] = $row["id"];
        }
        if (empty($output)) {
            return [];
        }

        $query = " 
                  SELECT t1.id, t1.name as unit, COUNT(t1.id) AS nr
                  FROM game_manufacturers as t1
                  INNER JOIN casinos__game_manufacturers AS t2 ON t1.id = t2.game_manufacturer_id AND t2.casino_id IN (" . implode(",", array_unique(array_values($output))) . ")
                  WHERE t1.is_open = 1
                  GROUP by t1.name
                  ORDER By t1.priority DESC";

        return SQL($query)->toList();
    }

    public function getTopPicks($country)
    {
        $resultSet = SQL("SELECT t2.id, t2.name, t2.code, IF(t3.casino_id IS NOT NULL, 1, 0) AS is_country_supported
        FROM `top_picks` AS `t1` 
        INNER JOIN `casinos` AS `t2` ON (`t1`.`n_c_id` = `t2`.`id`) 
        LEFT JOIN casinos__countries_allowed AS t3 ON (t2.id = t3.casino_id) AND t3.country_id = {$country}
        WHERE `t1`.`date`='" . date("Y-m-01") . "'");

        while ($row = $resultSet->toRow()) {
            $object = new Casino();
            $object->id = $row["id"];
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
        WHERE t1.casino_id IN (" . implode(",", array_keys($output)) . ") AND t2.name IN ('No Deposit Bonus','First Deposit Bonus','Free Spins','Free Play','Bonus Spins')
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
            if ($row["name"] == "No Deposit Bonus" || $row["name"] == "Free Spins" || $row["name"] == "Free Play" || $row["name"] == "Bonus Spins") {
                $output[$row["casino_id"]]->bonus_free = $bonus;
            } else {
                $output[$row["casino_id"]]->bonus_first_deposit = $bonus;
            }
        }

        return array_values($output);
    }

    public function getAllGameTypes()
    {
        $q = "SELECT t1.name FROM game_types AS t1";
        return SQL($q)->toList();
    }
}
