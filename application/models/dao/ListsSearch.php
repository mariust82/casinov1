<?php
require_once("vendor/lucinda/queries/plugins/MySQL/MySQLSelect.php");
require_once("ListSearchResults.php");

class ListsSearch
{
    private $value;
    public function __construct($value = '')
    {
        $this->value = $value;
    }
    
    public function getResults($offset=0, $limit=0)
    {
        if ($this->value == "") {
            return $this->setData($this->getSoftwares());
        }
        $results = new ListSearchResults($offset, $limit);
        $continue = $results->add($this->getCasinos());
        if ($continue) {
            $continue = $results->add($this->getSoftwares());
        }
        if ($continue) {
            $continue = $results->add($this->getBonuses());
        }
        if ($continue) {
            $continue = $results->add($this->getCountries());
        }
        if ($continue) {
            $continue = $results->add($this->getBanking());
        }
        if ($continue) {
            $continue = $results->add($this->getGames());
        }
        return $this->setData($results->get());
    }
    
    public function setData($arr)
    {
        for ($i = 0;$i<count($arr);$i++) {
            $row = SQL("SELECT * FROM pages WHERE url=:url", array(":url"=>$arr[$i]['url']))->toRow();
            if ($arr[$i]['url'] != 'games/(type)') {
                $arr[$i]['url'] = str_replace('(name)', strtolower(str_replace(' ', '-', $arr[$i]['name'])), $arr[$i]['url']);
            } else {
                $arr[$i]['url'] = str_replace('(type)', strtolower(str_replace(' ', '-', $arr[$i]['name'])), $arr[$i]['url']);
            }
            $arr[$i]['title'] = str_replace("(year)", date('Y'), str_replace("(month)", date('F'), str_replace("(name)", $arr[$i]['name'], $row['body_title'])));
        }
        return $arr;
    }
    
    public function getSoftwares()
    {
        if ($this->value == "") {
            $select = new Lucinda\Query\Select("game_manufacturers", "t1");
            $select->fields([
                ' t1.name AS unit',
                'count(t1.id) as counter'
            ]);

            $select->joinInner('casinos__game_manufacturers', 't2')->on(['t1.id' => 't2.game_manufacturer_id']);
            $select->joinInner('casinos', 't3')->on(['t2.casino_id' => 't3.id']);
            $where =  $select->where();
            $where->set('t3.is_open', 1);
            $where->setIn('t1.name', ["'RTG'", "'NetEnt'", "'Playtech'"]);
            $select->groupBy(['t1.id']);
            $select->orderBy()->add('t1.id', Lucinda\Query\OrderByOperator::DESC);
            $query = $select->toString();
            $res = SQL($query);
        } else {
            $select = new Lucinda\Query\Select("game_manufacturers", "t1");
            $select->fields([
                ' t1.name AS unit',
                'count(t1.id) as counter'
            ]);

            $select->joinInner('casinos__game_manufacturers', 't2')->on(['t1.id' => 't2.game_manufacturer_id']);
            $select->joinInner('casinos', 't3')->on(['t2.casino_id' => 't3.id']);
            $where =  $select->where();
            $where->set('t3.is_open', 1);
            $where->setLike('t1.name', "'%".$this->value."%'");
            $select->groupBy(['t1.id']);
            $select->orderBy()->add('counter', Lucinda\Query\OrderByOperator::DESC);
            $query = $select->toString();
            $res = SQL($query);
        }

        $output = array();
        $i = 0;
        while ($row = $res->toRow()) {
            $output[$i]['name'] = $row['unit'];
            $output[$i]['count'] = $row['counter'];
            $output[$i]['url'] = "softwares/(name)";
            $i++;
        }
        return $output;
    }
    
    public function getBonuses()
    {
        $select = new Lucinda\Query\Select("bonus_types", "t1");
        $select->fields([
           ' t1.name AS unit',
            'count(t1.id) as counter'
        ]);
        $select->joinInner('casinos__bonuses', 't2')->on(['t1.id' => 't2.bonus_type_id']);
        $select->joinInner('casinos', 't3')->on(['t2.casino_id' => 't3.id']);
        $where =  $select->where();
        $where->setIn('t1.name', ['"Free Play"', '"Free Spins"', '"No Deposit Bonus"']);
        $where->set('t3.is_open', 1);
        $where->setLike('t1.name', ':search_value');
        $res = SQL($select->toString(), [':search_value' => $this->value ]);
        $output = $this->loop($res, "bonus-list/(name)");
        return $output;
    }

    public function getCasinos()
    {
        $select = new Lucinda\Query\Select("casino_labels", "t1");
        $select->fields(['t1.name AS unit', 'count(t1.id) as counter']);
        $select->joinInner('casinos__labels', 't2')->on(['t1.id' => 't2.label_id']);
        $select->joinInner('casinos', 't3')->on(['t2.casino_id' => 't3.id']);
        $where =  $select->where();
        $where->set('t3.is_open', 1);
        $where->set('t1.id', 8, Lucinda\Query\ComparisonOperator::DIFFERS);
        $where->setLike('t1.name', ':search_value');
        $select->groupBy(['t1.id']);
        $select->orderBy()->add('counter', Lucinda\Query\OrderByOperator::DESC);
        $res = SQL($select->toString(), [':search_value' => $this->value ]);

        $labels = $this->loop($res, "casinos/(name)");

        $play_versions_query  = new Lucinda\Query\Select("play_versions", "t1");
        $play_versions_query->fields(['t1.name AS unit', 'count(t1.id) as counter']);
        $play_versions_query->joinInner('casinos__play_versions', 't2')->on(['t1.id' => 't2.play_version_id']);
        $play_versions_query->joinInner('casinos', 't3')->on(['t2.casino_id' => 't3.id']);
        $where =  $play_versions_query->where();
        $where->set('t3.is_open', 1);
        $group = new Lucinda\Query\Condition(array(), Lucinda\Query\LogicalOperator::_OR_);
        $group->set('t1.id', 4);
        $group->set('t1.id', 2);
        $where->setGroup($group);
        $where->setLike('t1.name', "'%".$this->value."%'");
        $play_versions_query->groupBy(['t1.id']);
        $play_versions_query->orderBy()->add('counter', Lucinda\Query\OrderByOperator::DESC);
        $res = SQL($play_versions_query->toString());

        $mobile = $this->loop($res, "compatability/(name)");

        $array = array_merge($labels, $mobile);
        $certifications  = new Lucinda\Query\Select("certifications", "t1");
        $certifications->fields(['t1.name AS unit', 'count(t1.id) as counter']);
        $certifications->joinInner('casinos__certifications', 't2')->on(['t1.id' => 't2.certification_id']);
        $certifications->joinInner('casinos', 't3')->on(['t2.casino_id' => 't3.id']);
        $where =  $certifications->where();
        $where->set('t3.is_open', 1);
        $where->set('t1.id', 6);
        $where->setLike('t1.name', "'%".$this->value."%'");
        $certifications->groupBy(['t1.id']);
        $certifications->orderBy()->add('counter', Lucinda\Query\OrderByOperator::DESC);
        $res = SQL($certifications->toString());

        $features = $this->loop($res, "features/(name)");
        return array_merge($array, $features);
    }
    
    private function loop($res, $url)
    {
        $arr = array();
        $i = 0;
        while ($row = $res->toRow()) {
            if (!$row['unit'] || stristr($row['unit'], 'germany') !== false) {
                continue;
            }
            $arr[$i]['name'] = $row['unit'];
            $arr[$i]['count'] = $row['counter'];
            $arr[$i]['url'] = $url;
            $i++;
        }
        return $arr;
    }
    
    public function getCountries()
    {
        $select  = new Lucinda\Query\MySQLSelect("countries", "t1");
        $select->setStraightJoin();
        $select->fields(['t1.name AS unit', 'count(t1.id) as counter']);
        $select->joinInner('casinos__countries_allowed', 't2')->on(['t1.id' => 't2.country_id']);
        $select->joinInner('casinos', 't3')->on(['t2.casino_id' => 't3.id']);
        $where =  $select->where();
        $where->set('t3.is_open', 1);
        $where->set('t1.code', "'" . Countries::EXCLUDED_COUNTRY_CODE . "'", Lucinda\Query\ComparisonOperator::DIFFERS);
        $where->setLike('t1.name', "'%".$this->value."%'");
        $select->groupBy(['t1.id']);
        $select->orderBy()->add('counter', Lucinda\Query\OrderByOperator::DESC);
        $res = SQL($select->toString());
        $output = $this->loop($res, "countries-list/(name)");
        return $output;
    }
    
    public function getBanking()
    {
        $select  = new Lucinda\Query\Select("banking_methods", "t1");
        $select->fields(['t1.name AS unit', 'count(t1.id) as counter']);
        $select->joinInner('casinos__deposit_methods', 't2')->on(['t1.id' => 't2.banking_method_id']);
        $select->joinInner('casinos', 't3')->on(['t2.casino_id' => 't3.id']);
        $where =  $select->where();
        $where->set('t3.is_open', 1);
        $where->setLike('t1.name', "'%".$this->value."%'");
        $select->groupBy(['t1.id']);
        $select->orderBy()->add('counter', Lucinda\Query\OrderByOperator::DESC);
        $res = SQL($select->toString());
        $output = $this->loop($res, "banking/(name)");
        return $output;
    }
    
    public function getGames()
    {
        $select  = new Lucinda\Query\Select("game_types", "t1");
        $select->fields(['t1.name AS unit', 'count(t1.id) as counter']);
        $select->joinInner('games', 't2')->on(['t1.id' => 't2.game_type_id']);
        $where =  $select->where();
        $where->setLike('t1.name', "'%".$this->value."%'");
        $select->groupBy(['t1.id']);
        $select->orderBy()->add('counter', Lucinda\Query\OrderByOperator::DESC);
        $res = SQL($select->toString());
        $output = $this->loop($res, "games/(type)");
        return $output;
    }

    public function getSearchSuggestions($user_country){
        return array(
            'No Deposit Casinos' => '/bonus-list/no-deposit-bonus',
            'New Casinos' => '/casinos/new',
             $user_country . ' Casinos for '. $user_country . ' players' => '/countries-list/'  . strtolower($user_country),
            'Low Wagering Casinos' => '/casinos/low-wagering',
            'Live Dealer Casinos' => '/features/live-dealer',
            'RTG Casinos' => '/softwares/rtg',
            'NetEnt Casinos' => '/softwares/netent',
            'BetSoft Casinos' => '/softwares/betsoft',
            'Rival Casinos' => '/softwares/rival',
            'MicroGaming Casinos' => '/softwares/microgaming');
    }
}
