<?php
require_once("CasinoCounter.php");
require_once("FieldValidator.php");

class PlayVersions implements CasinoCounter
{
    public function getCasinosCount()
    {
        return SQL("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM play_versions AS t1
        INNER JOIN casinos__play_versions AS t2 ON t1.id = t2.play_version_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t1.name IN ('Flash','Mobile') AND t3.is_open = 1
        GROUP BY t1.id
        ORDER BY counter DESC
        ")->toMap("unit", "counter");
    }

    public function getNumberOfCasinos($playVersionName)
    {
        $select = new Lucinda\Query\MySQLSelect("play_versions", "t1");
        $select->joinInner("casinos__play_versions","t2")->on(["t1.id"=>"t2.play_version_id"]);
        $select->joinInner("casinos","t3")->on(["t2.casino_id"=>"t3.id"]);
        if ($playVersionName == "Live Dealer"){
            $select->fields()->add("DISTINCT t2.id");
            $select->joinInner("casinos__game_types", "t4")->on(["t4.casino_id" => "t1.id"])->set("t4.is_live", 1);
            $select->joinInner("game_types", "t5")->on(["t5.id" => "t4.game_type_id"]);
        } else {
            $select->fields()->add("*");
        }
        $where = $select->where();
        $where->set("t1.name", ":name");
        return SQL($select->toString(), array(":name"=>$playVersionName))->toValue();
    }

    public function validate($name)
    {
        return SQL("SELECT name FROM play_versions WHERE name=:name", array(":name"=>$name))->toValue();
    }
}
