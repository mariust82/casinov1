<?php
namespace CasinosLists;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GamePlayQuery
 *
 * @author matan
 */
class GamePlayQuery extends \Hlis\GameInfoQuery {
     protected function setJoins() {
        $addFeatures = false;
        foreach($this->fields as $name=>$value) {
            if(!$value) continue;
            switch($name) {
                case "manufacturer":
                    $this->select->joinInner("game_manufacturers","t2")->on(["t1.game_manufacturer_id"=>"t2.id"]);
                    break;
                case "type":
                    $this->select->joinInner("game_types","t3")->on(["t1.game_type_id"=>"t3.id"]);
                    break;
                case "themes":
                    $this->select->joinInner("games__themes","t4")->on(["t1.id"=>"t4.game_id"]);
                    $this->select->joinInner("game_themes","t5")->on(["t4.theme_id"=>"t5.id"]);
                    break;
                case "is_mobile":
                case "is_desktop":
                    $this->select->joinLeft("game_play__matches","t6")->on(["t1.id"=>"t6.game_id"]);
                    $this->select->joinLeft("game_play__patterns","t7")->on()
                        ->set("t7.id", "t6.pattern_id")
                        ->setIn("t7.isMobile", ($this->fields->is_mobile?[1,2]:[0,2]));
                    break;
                case "is_flash":
                case "is_html5":
                case "is_progressive":
                case "is_non_progressive":
                case "is_3d_animation":
                case "is_3d_technology":
                case "is_autoplay":
                case "is_bonus_round":
                case "is_free_spins":
                case "is_live_dealer":
                case "is_multiplier":
                case "is_scatter":
                case "is_wild":
                case "is_macau":
                case "is_vegas":
                    $addFeatures = true;
                    break;
            }
        }
        if($addFeatures) {
            $this->select->joinLeft("games__features","t8")->on(["t1.id"=>"t8.game_id"]);
            $this->select->joinInner("game_features","t9")->on(["t8.feature_id"=>"t9.id"]);
        }
    }
}
