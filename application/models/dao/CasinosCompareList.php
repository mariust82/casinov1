<?php
require_once("CasinosList.php");

class CasinosCompareList extends CasinosList
{
    public function getList(Casino $casino, $limit)
    {
        
        $resultSet = SQL("
        SELECT
        t1.id, t1.name, t1.code, (t1.rating_total/t1.rating_votes) AS average_rating, t1.rating_votes, t1.deposit_minimum, t1.withdraw_minimum, t1.date_established, IF(t1.tc_link<>'',1,0) AS is_tc_link
        FROM casinos AS t1
        INNER JOIN casinos__countries_allowed AS t2 ON t1.id = t2.casino_id AND t2.country_id = :country
        INNER JOIN casinos__game_manufacturers AS t3 ON t1.id = t3.casino_id AND t3.game_manufacturer_id = (SELECT id FROM game_manufacturers WHERE name = :software)
        INNER JOIN casinos__bonuses AS t4 ON t1.id = t4.casino_id
        INNER JOIN bonus_types AS t5 ON t4.bonus_type_id = t5.id
        WHERE t1.id <> :id AND t1.status_id IN (0,1) AND t5.name IN ('Free Spins', 'No Deposit Bonus', 'Free Play', 'Bonus Spins') AND t4.amount NOT IN ('none', '')
        ORDER BY t1.priority DESC, t1.id DESC
        LIMIT ".$limit, [
            ":country"=>$this->filter->getDetectedCountry()->id,
            ":software"=>$casino->softwares[0],
            ":id"=>$casino->id
        ]);        
        while ($row = $resultSet->toRow()) {
            $object = new Casino();
            $object->id = $row["id"];
            $object->name = $row["name"];
            $object->code = $row["code"];
            $object->rating = ceil($row["average_rating"]);
            $object->rating_votes = $row["rating_votes"];
            $object->date_established = $row["date_established"];
            $object->deposit_minimum = $row["deposit_minimum"];
            $object->withdrawal_minimum = $row["withdraw_minimum"];
            $object->is_tc_link = $row["is_tc_link"];
            $object->is_country_accepted = true;
            $output[$row["id"]] = $object;
        }
        if (empty($output)) {
            return array();
        }
        $allowedIds = implode(",", array_keys($output));
        
        $this->appendAcceptedCountry($output, $allowedIds);
        $this->appendAcceptedCurrency($output, $allowedIds);
        $this->appendAcceptedLanguage($output, $allowedIds);
        $this->appendPrimaryCurrencySymbols($output, $allowedIds);
        $this->appendBonuses($output, $allowedIds);
                
        return array_values($output);
    }
}

