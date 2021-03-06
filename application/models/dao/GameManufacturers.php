<?php
require_once("CasinoCounter.php");
require_once("FieldValidator.php");

class GameManufacturers implements CasinoCounter
{
    public function getTopProviders($countryID, $limit)
    {
        $software = [];
        $resultSet = SQL("
            SELECT t1.id, t1.name, t1.priority
            FROM game_manufacturers AS t1 
            LEFT JOIN game_manufacturers__countries AS t2 ON t1.id = t2.game_manufacturer_id AND t2.country_id = :country 
            WHERE t1.is_open = 1 AND (t2.id IS NULL OR t2.is_allowed=1)
            ORDER BY priority DESC, id DESC
            LIMIT ".$limit, [":country"=>$countryID]);


      /*  $resultSet = SQL("
        (
        SELECT t1.id, t1.name, t1.priority
        FROM game_manufacturers AS t1
        LEFT JOIN game_manufacturers__countries AS t2 ON t1.id = t2.game_manufacturer_id
        WHERE t1.is_open = 1 AND t2.id IS NULL
        )        
        UNION        
        (
        SELECT t1.id, t1.name, t1.priority
        FROM game_manufacturers AS t1
        INNER JOIN game_manufacturers__countries AS t2 ON t1.id = t2.game_manufacturer_id AND t2.country_id = :country AND is_allowed = 1
        WHERE t1.is_open = 1
        )        
        UNION        
        (
        SELECT t1.id, t1.name, t1.priority
        FROM game_manufacturers AS t1
        INNER JOIN game_manufacturers__countries AS t2 ON t1.id = t2.game_manufacturer_id AND t2.is_allowed = 0
        LEFT JOIN game_manufacturers__countries AS t3 ON t2.id = t3.id AND t3.country_id = :country AND t3.is_allowed = 0
        WHERE t1.is_open = 1 AND t3.id IS NULL
        )
        ORDER BY priority DESC, id DESC
        LIMIT ".$limit, [":country"=>$countryID]); */

        while($row = $resultSet->toRow()) {
            $software[$row["id"]] = [
                "name"=>$row["name"],
                "casinos"=>0
            ];
        }
        
        // get number of casinos for above
        $resultSet = SQL("
        SELECT COUNT(DISTINCT casino_id) AS nr, game_manufacturer_id
        FROM casinos__game_manufacturers
        INNER JOIN  casinos as c ON casino_id = c.id AND c.is_open=1
        WHERE game_manufacturer_id IN (".implode(",", array_keys($software)).")
        GROUP BY game_manufacturer_id
        ");
        while($row = $resultSet->toRow()) {
            $software[$row["game_manufacturer_id"]]["casinos"] = $row["nr"];
        }
        
        return $software;
    }
    
    public function getCasinosCount()
    {
        return SQL("
        SELECT
        t1.name AS unit, count(t1.id) as counter
        FROM game_manufacturers AS t1
        INNER JOIN casinos__game_manufacturers AS t2 ON t1.id = t2.game_manufacturer_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1
        GROUP BY t1.id
        ORDER BY sort DESC, counter DESC, t1.id DESC 
        ")->toMap("unit", "counter");
    }

    public function getAll()
    {
        return SQL("
        SELECT DISTINCT t1.name
        FROM game_manufacturers AS t1
        INNER JOIN casinos__game_manufacturers AS t2 ON t1.id = t2.game_manufacturer_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t3.is_open = 1
        ORDER BY t1.name ASC 
        ")->toColumn();
    }
    
    public function getAllByGameType($is_mobile,$type)
    {
        $feature_id = $is_mobile == TRUE ? 7 : 8;
        $mobile = $is_mobile == TRUE ? 1 : 0;
        return SQL("
        SELECT DISTINCT t2.name
        FROM games AS t1
        INNER JOIN game_manufacturers AS t2 ON t1.game_manufacturer_id = t2.id
        INNER JOIN game_types AS t3 ON t1.game_type_id = t3.id AND t3.name = :type
        INNER JOIN game_play__matches AS t6 ON t1.id = t6.game_id
        INNER JOIN game_play__patterns AS t7 ON t7.id = t6.pattern_id AND t7.isMobile IN ({$mobile},2)
        INNER JOIN games__features AS t8 ON t1.id = t8.game_id AND t8.feature_id = {$feature_id}
        WHERE t2.is_open = 1 AND t1.is_open = 1
        ", [':type' => $type])->toColumn();
    }

    public function getSoftwareByType()
    {
        return SQL("
        SELECT name AS unit
        FROM game_manufacturers
        ")->toMap("unit", "unit");
    }

    public function getGameManufactures($id)
    {
        return SQL("SELECT name FROM game_manufacturers WHERE id=:id", array(":id"=>$id))->toValue();
    }
}
