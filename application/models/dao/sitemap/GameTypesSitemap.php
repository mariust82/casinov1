<?php
require_once 'application/models/dao/sitemap/Sitemap.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GameTypesSitemap
 *
 * @author matan
 */
class GameTypesSitemap extends Sitemap {
  
    private function setGameTypesRows() {
        $output = [];
        $types = $this->getAll();
        foreach ($types as $key => $value) {
            $output[$value] = explode(' ',SQL("SELECT MAX(t1.date) FROM games AS t1 INNER JOIN game_manufacturers AS t2 ON t1.game_manufacturer_id = t2.id INNER JOIN game_types AS t3 ON t1.game_type_id = t3.id INNER JOIN game_play__matches AS t6 ON t1.id = t6.game_id INNER JOIN game_play__patterns AS t7 ON t7.id = t6.pattern_id AND t7.isMobile IN (0,1,2) INNER JOIN games__features AS t8 ON t1.id = t8.game_id AND t8.feature_id IN(7,8) WHERE t3.id = {$key} AND t1.is_open = 1")->toValue())[0];
        }
        array_multisort($output, SORT_DESC);
        return $output;
    }
    
    public function getGameTypesRows() {
        return $this->setGameTypesRows();
    }
    
    private function getAll()
    {
        return SQL("
        SELECT DISTINCT t1.name,t1.id
        FROM game_types AS t1
        INNER JOIN games AS t2 ON t1.id = t2.game_type_id
        ORDER BY t1.name ASC 
        ")->toMap("id","name");
    }
}
