<?php
require_once("CasinoCounter.php");
require_once("FieldValidator.php");

class BonusTypes implements CasinoCounter
{
    public function getCasinosCount() {
        return SQL("
        SELECT
        t1.name AS unit, count(*) as counter
        FROM bonus_types AS t1
        INNER JOIN casinos__bonuses AS t2 ON t1.id = t2.bonus_type_id
        INNER JOIN casinos AS t3 ON t2.casino_id = t3.id
        WHERE t1.name IN ('Free Play', 'Free Spins', 'No Deposit Bonus') AND t3.is_open = 1
        GROUP BY t1.id
        ORDER BY counter DESC 
        ")->toMap("unit","counter");
    }

  /*  public function validate($name) {
        return SQL("SELECT name FROM bonus_types WHERE name=:name",array(":name"=>$name))->toValue();
    }*/
}