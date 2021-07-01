<?php

require_once("AbstractQuery.php");
require_once("MariaDBSelectGroup.php");
require_once("application/models/dao/BestCasinoLabel.php");
require_once("vendor/lucinda/queries/plugins/MySQL/MySQLSelect.php");

/**
 * Class CasinosQuery
 */
abstract class CasinosQuery extends AbstractQuery
{
    const CASINO_SCORE = 7.5;
    const CASINO_MIN_VOTES = 10;
    const CASINO_MINIMUM_DEPOSIT_MIN = 1;
    const CASINO_MINIMUM_DEPOSIT_MAX = 5;

    /**
     * @var CasinoFilter
     */
    protected CasinoFilter $filter;

    /**
     * CasinosQuery constructor.
     *
     * @param CasinoFilter $filter
     * @param array $columns
     * @param int|null $sortBy
     * @param int|null $limit
     * @param int|null $offset
     */
    public function __construct(CasinoFilter $filter, array $columns = [], ?int $sortBy = null, ?int $limit = 0, ?int $offset = 0)
    {
        $this->select = new \Lucinda\Query\Select("casinos", "t1");
        $this->filter = $filter;
        $this->setFields($columns);
        $this->setJoins();
        $this->setWhere();
        $this->setOrderBy($sortBy);
        $this->setGroupBy($limit);
        $this->setLimit($offset, $limit);
    }

    /**
     * Set joins.
     *
     * @param CasinoFilter $filter
     */
    private function setJoins()
    {
        $this->select->joinInner("casino_statuses_extended", "t19")->on(["t1.status_id" => "t19.status_id"]);
        $this->select->joinLeft("casino_statuses", "cs")->on(["t1.status_id" => "cs.id"]);
        if ($this->filter->getCurrencyAccepted()) {
            $this->select->joinInner("casinos__currencies", "t15")->on(["t1.id" => "t15.casino_id", "t15.currency_id" => ":currency_id"]);
            $this->parameters[":currency_id"] = $this->filter->currency_id;
        }
        if ($this->filter->getLanguageAccepted()) {
            $this->select->joinInner("casinos__languages", "t16")->on(["t1.id" => "t16.casino_id", "t16.language_id" => ":language_id"]);
            $this->parameters[":language_id"] = $this->filter->language_id;
        }
        if ($this->filter->getCountryAccepted()) {
            $this->select->joinInner("casinos__countries_allowed", "t2")->on(["t1.id" => "t2.casino_id", "t2.country_id" => ":country_id"]);
            $this->parameters[":country_id"] = $this->filter->getDetectedCountry()->id;
        }
        if ($this->filter->getBonusType() || $this->filter->getFreeBonus()) {
            $condition = $this->select->joinInner("casinos__bonuses", "t4")->on();
            $condition->set("t1.id", "t4.casino_id");
            if ($this->filter->getBonusType() && in_array(strtolower($this->filter->getBonusType()), array("free spins", "no deposit bonus"))) {
                // free bonus is no longer relevant
                $sub_query = new Lucinda\Query\MySQLSelect("bonus_types");
                $sub_query->fields(["id"]);
                $sub_query->where(["name" => ":bonusTypeName"]);
                $this->parameters[":bonusTypeName"] = $this->filter->getBonusType();
                $condition->set("t4.bonus_type_id", "(" . $sub_query->toString() . ")");
            } else {
                if ($this->filter->getBonusType()) {
                    $sub_query = new Lucinda\Query\MySQLSelect("bonus_types");
                    $sub_query->fields(["id"]);
                    $sub_query->where(["name" => ":bonusTypeName"]);
                    $this->parameters[":bonusTypeName"] = $this->filter->getBonusType();
                    $condition->set("t4.bonus_type_id", "(" . $sub_query->toString() . ")");
                }
                if ($this->filter->getFreeBonus()) {
                    $condition->setIn("t4.bonus_type_id", [3, 4, 5, 6, 11]);
                }
            }
        }
        if ($this->filter->getCasinoLabel()) {
            if ($this->filter->getCasinoLabel() == 'Blacklisted Casinos') {
                $this->filter->setPromoted(false);
            }

            if ($this->filter->getCasinoLabel() == 'Fast Payout') {
                $this->select->joinInner("casinos__withdraw_timeframes ", "t18")->on(["t1.id" => "t18.casino_id"])->set("t18.unit", "'hour'")->set("t18.end", 24, Lucinda\Query\ComparisonOperator::LESSER_EQUALS);
            }

            if (!in_array($this->filter->getCasinoLabel(), ["New", "all", "Best", "Fast Payout", "Low Minimum Deposit"])) {
                $sub_query = new Lucinda\Query\MySQLSelect("casino_labels");
                $sub_query->fields(["id"]);
                $sub_query->where(["name" => ":casinoLabel"]);
                $this->parameters[":casinoLabel"] = $this->filter->getCasinoLabel();
                $this->select->joinInner("casinos__labels", "t5")->on(["t1.id" => "t5.casino_id", "t5.label_id" => "(" . $sub_query->toString() . ")"]);
            }
        }
        if ($this->filter->getCertification()) {
            $sub_query = new Lucinda\Query\MySQLSelect("certifications");
            $sub_query->fields(["id"]);
            $sub_query->where(["name" => ":certification"]);
            $this->parameters[":certification"] = $this->filter->getCertification();
            $this->select->joinInner("casinos__certifications", "t6")->on(["t1.id" => "t6.casino_id", "t6.certification_id" => "(" . $sub_query->toString() . ")"]);
        }
        if ($this->filter->getCountry()) {
            $sub_query = new Lucinda\Query\MySQLSelect("countries");
            $sub_query->fields(["id"]);
            $sub_query->where(["name" => ":countryName"]);
            $this->parameters[":countryName"] = $this->filter->getCountry();
            $this->select->joinInner("casinos__countries_allowed", "t7")->on(["t1.id" => "t7.casino_id", "t7.country_id" => "(" . $sub_query->toString() . ")"]);
        }
        if ($this->filter->getOperatingSystem()) {
            $sub_query = new Lucinda\Query\MySQLSelect("operating_systems");
            $sub_query->fields(["id"]);
            $sub_query->where(["name" => ":operatingSystem"]);
            $this->parameters[":operatingSystem"] = $this->filter->getOperatingSystem();
            $this->select->joinInner("casinos__operating_systems", "t8")->on(["t1.id" => "t8.casino_id", "t8.casino_id" => "(" . $sub_query->toString() . ")"]);
        }
        if ($this->filter->getPlayVersion()) {
            if (!empty($this->filter->getPlayVersionType())) {
                $this->select->joinInner("casinos__game_types", "t11")->on(["t11.casino_id" => "t1.id"]);
                $this->select->joinInner("game_types", "t12")->on(["t12.id" => "t11.game_type_id"]);
            } else {
                $sub_query = new Lucinda\Query\MySQLSelect("play_versions");
                $sub_query->fields(["id"]);
                $sub_query->where(["name" => ":playVersion"]);
                $this->parameters[":playVersion"] = $this->filter->getPlayVersion();
                $this->select->joinInner("casinos__play_versions", "t9")->on(["t1.id" => "t9.casino_id", "t9.play_version_id" => "(" . $sub_query->toString() . ")"]);
            }
        }
        if ($this->filter->getSoftware()) {
            $sub_query = new Lucinda\Query\MySQLSelect("game_manufacturers");
            $sub_query->fields(["id"]);
            $sub_query->where(["name" => ":software"]);
            $this->parameters[":software"] = $this->filter->getSoftware();
            $this->select->joinInner("casinos__game_manufacturers", "t10")->on(["t1.id" => "t10.casino_id", "t10.game_manufacturer_id" => "(" . $sub_query->toString() . ")"]);
        }
        if ($this->filter->getGame()) {
            $sub_query = new Lucinda\Query\MySQLSelect("game_manufacturers");
            $sub_query->fields(["id"]);
            $sub_query->where(["name" => ":game"]);
            $this->parameters[":game"] = $this->filter->getGame();
            $this->select->joinInner("casinos__game_manufacturers", "t10")->on(["t1.id" => "t10.casino_id", "t10.game_manufacturer_id" => "(" . $sub_query->toString() . ")"]);
        }
        if ($this->filter->getSoftwares()) {
            $this->select->joinInner("casinos__game_manufacturers", "t20")->on(["t1.id" => "t20.casino_id"])->setIn("t20.game_manufacturer_id", ":softwares");
            $this->parameters[":softwares"] = $this->filter->getSoftwares();
        }
        if ($this->filter->getCasinoLabel() && $this->filter->getCasinoLabel() === "Low Minimum Deposit") {
            $this->select->joinInner("casinos__currencies", "cc")->on(["t1.id" => "cc.casino_id"]);
            $this->select->joinInner("currencies", "c")->on(["c.id" => "cc.currency_id"]);
        }
    }

    /**
     * Set where.
     *
     * @param CasinoFilter $filter
     */
    protected function setWhere(): void
    {
        $where = $this->select->where();
        $where->set("t1.is_open", 1);
        if ($this->filter->getHighRoller()) {
            $where->set("t1.is_high_roller", 1);
        }
        if ($this->filter->getPromoted()) {
            $where->set("t1.status_id", 0);
        }
        if ($this->filter->getCasinoLabel() === 'Fast Payout') {
            $where->set("t1.status_id", 1, Lucinda\Query\ComparisonOperator::DIFFERS);
        }
        switch ($this->filter->getCasinoLabel()) {
            case 'New':
                $where->set("t1.date_established", "'" . date("Y-m-d", strtotime(date("Y-m-d") . " -1 year")) . "'", Lucinda\Query\ComparisonOperator::GREATER);
                break;
            case 'Best':
                $this->addBestCondition($where);
                break;
            case 'Low Minimum Deposit':
                $this->addLowMinimumDepositCondition($where);
                break;
        }
        if ($this->filter->getBankingMethod() || $this->filter->getBankingMethod() === 0) {
            $group = new MariaDBSelectGroup();
            $tables = ['casinos__deposit_methods', 'casinos__withdraw_methods'];
            foreach ($tables as $key => $table) {
                $one = new Lucinda\Query\Select($table);
                $one->fields(["casino_id"]);
                $one->where(["banking_method_id" => ":banking_method_id{$key}"]);
                $this->parameters[":banking_method_id{$key}"] = $this->filter->getBankingMethod();
                $group->addSelect($one);
            }
            $where->setIn("t1.id", $group);
        }
        if (!empty($this->filter->getPlayVersionType())) {
            $where->set("t11.is_live", 1);
            $where->set("t12.name", ":playVersionType");
            $this->parameters[":playVersionType"] = $this->filter->getPlayVersionType();
        }
        if ($this->filter->getPlayVersion() === 'Live Dealer') {
            $sub_query = new Lucinda\Query\MySQLSelect("casinos__game_types");
            $sub_query->fields(["casino_id"]);
            $sub_query->where(["is_live" => "1"]);
            $where->setIn("t1.id", $sub_query);
        }
    }

    /**
     * Add the conditions for "Best Casinos page":
     * Display open casinos that are not closed/ blacklisted/ warning (Brand Admin - Status)
     * Display casinos that are on the market for at least 6 months (Brand Admin - Established)
     * The casino score should be 7.5 and above, out of at least 10 votes
     *
     * @param \Lucinda\Query\Condition $where
     */
    protected function addBestCondition(Lucinda\Query\Condition $where)
    {
        $where->setIn("t1.status_id", [0, 3]);
        $where->set("t1.date_established", "'" . date("Y-m-d", strtotime(date("Y-m-d") . " -6 months")) . "'", Lucinda\Query\ComparisonOperator::LESSER_EQUALS);
        $where->set("t1.rating_votes", self::CASINO_MIN_VOTES, Lucinda\Query\ComparisonOperator::GREATER_EQUALS);
        $where->set("(t1.rating_total/t1.rating_votes)", self::CASINO_SCORE, Lucinda\Query\ComparisonOperator::GREATER_EQUALS);
    }

    /**
     * @param \Lucinda\Query\Condition $where
     */
    protected function addLowMinimumDepositCondition(Lucinda\Query\Condition $where)
    {
        $where->setBetween("t1.deposit_minimum", self::CASINO_MINIMUM_DEPOSIT_MIN, self::CASINO_MINIMUM_DEPOSIT_MAX);
        $where->set("cc.is_primary", 1);
        $where->set("c.is_crypto", 0);
    }


    /**
     * Set group by
     *
     * @param CasinoFilter $filter
     * @param int|null $limit
     */
    protected function setGroupBy(?int $limit): void
    {
        if ($limit > 0 && ($this->filter->getPlayVersion() === 'Live Dealer' || $this->filter->getCasinoLabel() === 'Fast Payout')) {
            $this->select->groupBy(['t1.id']);
        }
    }

    /**
     * Set fields.
     *
     * @param array $fields
     * @param CasinoFilter $filter
     */
    abstract protected function setFields(array $fields = []): void;

    /**
     * Set order by
     *
     * @param int|null $sortBy
     */
    abstract protected function setOrderBy(?int $sortBy = null): void;

    /**
     * Set limit and offset.
     *
     * @param int|null $offset
     * @param int|null $limit
     */
    abstract protected function setLimit(?int $offset, ?int $limit): void;

}