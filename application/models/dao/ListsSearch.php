<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ListsSearch
 *
 * @author matan
 */
class ListsSearch {
    
    private $value;

    public function __construct($value) {
        $this->value = $value;
    }
    
    public function getResults($limit,$offset) {
        if ($this->value == "") {
            return $this->setData($this->getSoftwares($limit, $offset));
        }
        $caisnos = $this->getCasinos($limit, $offset);
        $softwares = $this->getSoftwares($limit, $offset);
        $bonuses = $this->getBonuses($limit, $offset);
        $countries = $this->getCountries($limit, $offset);
        $banking = $this->getBanking($limit, $offset);
        $games = $this->getGames($limit, $offset);
        $results = array_merge($caisnos,array_merge($softwares,array_merge($bonuses,array_merge($countries,array_merge($games,$banking)))));
//        var_dump($this->setData(array_slice($results, 0, 3)));
        return $this->setData(array_slice($results, 0, 3));
    }
    
    public function setData($arr) {
        for ($i = 0;$i<count($arr);$i++) {
            DB("SET NAMES UTF8");
            $row = DB("SELECT * FROM pages WHERE url=:url",array(":url"=>$arr[$i]['url']))->toRow();
            $arr[$i]['url'] = str_replace('(name)', strtolower(str_replace(' ', '-', $arr[$i]['name'])), $arr[$i]['url']);
            $arr[$i]['title'] = str_replace("(year)",date('Y'),str_replace("(month)",date('F'),str_replace("(name)", $arr[$i]['name'], $row['body_title'])));
        }
        return $arr;
    }
    
    public function getSoftwares($limit,$offset) {
        if ($this->value == "") {
            $query = "
            SELECT
            t1.name AS unit, count(*) as counter
            FROM game_manufacturers AS t1
            INNER JOIN casinos__game_manufacturers AS t2 ON t1.id = t2.game_manufacturer_id
            INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
            WHERE t3.is_open = 1 AND (t1.name = 'RTG' OR t1.name = 'NetEnt' OR t1.name = 'Playtech')
            GROUP BY t1.id
            ORDER BY t1.id DESC LIMIT ".$limit." OFFSET ".$offset."
            ";
        } else {
           $query = "
            SELECT
            t1.name AS unit, count(*) as counter
            FROM game_manufacturers AS t1
            INNER JOIN casinos__game_manufacturers AS t2 ON t1.id = t2.game_manufacturer_id
            INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
            WHERE t3.is_open = 1 AND t1.name LIKE '%".$this->value."%'
            GROUP BY t1.id
            ORDER BY counter DESC LIMIT ".$limit." OFFSET ".$offset."
            "; 
        }
        
        $res = DB($query);
        $output = array();
        $i = 0;
        while($row = $res->toRow()) {
            $output[$i]['name'] = $row['unit'];
            $output[$i]['count'] = $row['counter'];
            $output[$i]['url'] = "softwares/(name)";
            $i++;
        }
        return $output;
    }
    
    public function getBonuses($limit,$offset) {
        $res = DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM bonus_types AS t1
        INNER JOIN casinos__bonuses AS t2 ON t1.id = t2.bonus_type_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t1.name IN ('Free Play', 'Free Spins', 'No Deposit Bonus') AND t3.is_open = 1  AND t1.name LIKE '%".$this->value."%'
        GROUP BY t1.id
        ORDER BY counter DESC  LIMIT ".$limit." OFFSET ".$offset."
        ");
        $output = array();
        $i = 0;
        while($row = $res->toRow()) {
            $output[$i]['name'] = $row['unit'];
            $output[$i]['count'] = $row['counter'];
            $output[$i]['url'] = "bonus-list/(name)";
            $i++;
        }
        return $output;
    }

    public function getCasinos($limit,$offset) {
        $res =  DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM casino_labels AS t1
        INNER JOIN casinos__labels AS t2 ON t1.id = t2.label_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1 AND t1.id != 8 AND t1.name LIKE '%".$this->value."%'
        GROUP BY t1.id
        ORDER BY counter DESC LIMIT ".$limit." OFFSET ".$offset."
        ");
        $labels = array();
        $i = 0;
        while($row = $res->toRow()) {
            $labels[$i]['name'] = $row['unit'];
            $labels[$i]['count'] = $row['counter'];
            $labels[$i]['url'] = "casinos/(name)";
            $i++;
        }
        
        $res =  DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM play_versions AS t1
        INNER JOIN casinos__play_versions AS t2 ON t1.id = t2.play_version_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1 AND (t1.id = 4 OR t1.id = 2) AND t1.name LIKE '%".$this->value."%'
        GROUP BY t1.id
        ORDER BY counter DESC  LIMIT ".$limit." OFFSET ".$offset."
        ");
        $mobile = array();
        $i = 0;
        while($row = $res->toRow()) {
            $mobile[$i]['name'] = $row['unit'];
            $mobile[$i]['count'] = $row['counter'];
            $mobile[$i]['url'] = "compatability/(name)";
            $i++;
        }
        $array = array_merge($labels,$mobile);
        
        $res =  DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM certifications AS t1
        INNER JOIN casinos__certifications AS t2 ON t1.id = t2.certification_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1 AND t1.id = 6 AND t1.name LIKE '%".$this->value."%'
        GROUP BY t1.id
        ORDER BY counter DESC  LIMIT ".$limit." OFFSET ".$offset."
        ");
        $features = array();
        $i = 0;
        while($row = $res->toRow()) {
            $features[$i]['name'] = $row['unit'];
            $features[$i]['count'] = $row['counter'];
            $features[$i]['url'] = "features/(name)";
            $i++;
        }
        return array_merge($array,$features);
    }
    
    public function getCountries($limit,$offset) {
         $res = DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM countries AS t1
        INNER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.country_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1 AND t1.name LIKE '%".$this->value."%'
        GROUP BY t1.id
        ORDER BY counter DESC  LIMIT ".$limit." OFFSET ".$offset."
        ");
         $output = array();
        $i = 0;
        while($row = $res->toRow()) {
            $output[$i]['name'] = $row['unit'];
            $output[$i]['count'] = $row['counter'];
            $output[$i]['url'] = "countries-list/(name)";
            $i++;
        }
        return $output;
    }
    
    public function getBanking($limit,$offset) {
        $res = DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM banking_methods AS t1
        INNER JOIN casinos__deposit_methods AS t2 ON t1.id = t2.banking_method_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1 AND t1.name LIKE '%".$this->value."%'
        GROUP BY t1.id
        ORDER BY counter DESC  LIMIT ".$limit." OFFSET ".$offset."
        ");
        $output = array();
        $i = 0;
        while($row = $res->toRow()) {
            $output[$i]['name'] = $row['unit'];
            $output[$i]['count'] = $row['counter'];
            $output[$i]['url'] = "banking/(name)";
            $i++;
        }
        return $output;
    }
    
    public function getGames($limit,$offset) {
        $res = DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM game_types AS t1
        INNER JOIN games AS t2 ON t1.id = t2.game_type_id
        WHERE t1.name LIKE '%".$this->value."%'
        GROUP BY t1.id
        ORDER BY counter DESC   LIMIT ".$limit." OFFSET ".$offset."
        ");
        $output = array();
        $i = 0;
        while($row = $res->toRow()) {
            $output[$i]['name'] = $row['unit'];
            $output[$i]['count'] = $row['counter'];
            $output[$i]['url'] = "games/(type)";
            $i++;
        }
        return $output;
    }
}
