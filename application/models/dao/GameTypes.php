<?php
require_once("FieldValidator.php");

class GameTypes
{
    private $is_mobile;
    private $feature_id;
    
    public function __construct($is_mobile) {
        $this->is_mobile = $is_mobile;
        $this->feature_id = $this->is_mobile == TRUE ? 7 : 8;
    }

        public function getGamesCount()
    {
        return SQL("
        SELECT t3.name AS unit ,COUNT(DISTINCT t1.id) AS counter FROM games AS t1 INNER JOIN game_types AS t3 ON t1.game_type_id = t3.id INNER JOIN game_play__matches AS t6 ON t1.id = t6.game_id INNER JOIN game_play__patterns AS t7 ON t7.id = t6.pattern_id AND t7.isMobile IN (0,2) INNER JOIN games__features AS t8 ON t1.id = t8.game_id AND t8.feature_id = {$this->feature_id} WHERE t1.is_open = 1
        GROUP BY t3.id
        ORDER BY counter DESC 
        ")->toMap("unit", "counter");
    }

    public function getAll()
    {
        return SQL("
        SELECT DISTINCT t1.name
        FROM game_types AS t1
        INNER JOIN games AS t2 ON t1.id = t2.game_type_id
        ORDER BY t1.name ASC 
        ")->toColumn();
    }

    public function getGamesByType()
    {
        return SQL("
        SELECT
        t1.name AS unit, t2.name AS game
        FROM game_types AS t1
        INNER JOIN games AS t2 ON t1.id = t2.game_type_id
        GROUP BY t1.id
        ")->toMap("unit", "game");
    }
}
