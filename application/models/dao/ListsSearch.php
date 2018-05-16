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
    
    public function getResults() {
        if ($this->value == "") {
            return $this->setData($this->getSoftwares());
        }
        $caisnos = $this->getCasinos();
        $softwares = $this->getSoftwares();
        $bonuses = $this->getBonuses();
        $countries = $this->getCountries();
        $banking = $this->getBanking();
        $games = $this->getGames();
        $results = array_merge($caisnos,array_merge($softwares,array_merge($bonuses,array_merge($countries,array_merge($games,$banking)))));
        return $this->setData($results);
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
    
    public function getSoftwares() {
        if ($this->value == "") {
            $query = "
            SELECT
            t1.name AS unit, count(*) as counter
            FROM game_manufacturers AS t1
            INNER JOIN casinos__game_manufacturers AS t2 ON t1.id = t2.game_manufacturer_id
            INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
            WHERE t3.is_open = 1 AND (t1.name = 'RTG' OR t1.name = 'NetEnt' OR t1.name = 'Playtech')
            GROUP BY t1.id
            ORDER BY t1.id DESC
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
            ORDER BY counter DESC
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
    
    public function getBonuses() {
        $res = DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM bonus_types AS t1
        INNER JOIN casinos__bonuses AS t2 ON t1.id = t2.bonus_type_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t1.name IN ('Free Play', 'Free Spins', 'No Deposit Bonus') AND t3.is_open = 1  AND t1.name LIKE '%".$this->value."%'
        GROUP BY t1.id
        ORDER BY counter DESC 
        ");
        $output = $this->loop($res, "bonus-list/(name)");
        return $output;
    }

    public function getCasinos() {
        $res =  DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM casino_labels AS t1
        INNER JOIN casinos__labels AS t2 ON t1.id = t2.label_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1 AND t1.id != 8 AND t1.name LIKE '%".$this->value."%'
        GROUP BY t1.id
        ORDER BY counter DESC
        ");
        $labels = $this->loop($res,"casinos/(name)");
        
        $res =  DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM play_versions AS t1
        INNER JOIN casinos__play_versions AS t2 ON t1.id = t2.play_version_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1 AND (t1.id = 4 OR t1.id = 2) AND t1.name LIKE '%".$this->value."%'
        GROUP BY t1.id
        ORDER BY counter DESC 
        ");
        $mobile = $this->loop($res,"compatability/(name)");
        $array = array_merge($labels,$mobile);
        
        $res =  DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM certifications AS t1
        INNER JOIN casinos__certifications AS t2 ON t1.id = t2.certification_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1 AND t1.id = 6 AND t1.name LIKE '%".$this->value."%'
        GROUP BY t1.id
        ORDER BY counter DESC 
        ");
        $features = $this->loop($res,"features/(name)");
        return array_merge($array,$features);
    }
    
    private function loop($res,$url) {
        $arr = array();
        $i = 0;
        while($row = $res->toRow()) {
            $arr[$i]['name'] = $row['unit'];
            $arr[$i]['count'] = $row['counter'];
            $arr[$i]['url'] = $url;
            $i++;
        }
        return $arr;
    }
    
    public function getCountries() {
         $res = DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM countries AS t1
        INNER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.country_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1 AND t1.name LIKE '%".$this->value."%'
        GROUP BY t1.id
        ORDER BY counter DESC 
        ");
        $output = $this->loop($res,"countries-list/(name)");
        return $output;
    }
    
    public function getBanking() {
        $res = DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM banking_methods AS t1
        INNER JOIN casinos__deposit_methods AS t2 ON t1.id = t2.banking_method_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1 AND t1.name LIKE '%".$this->value."%'
        GROUP BY t1.id
        ORDER BY counter DESC 
        ");
        $output = $this->loop($res,"banking/(name)");
        return $output;
    }
    
    public function getGames() {
        $res = DB("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM game_types AS t1
        INNER JOIN games AS t2 ON t1.id = t2.game_type_id
        WHERE t1.name LIKE '%".$this->value."%'
        GROUP BY t1.id
        ORDER BY counter DESC  
        ");
        $output = $this->loop($res,"games/(type)");
        return $output;
    }
}
