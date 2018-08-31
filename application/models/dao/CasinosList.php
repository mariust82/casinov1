<?php
require_once("entities/Casino.php");
require_once("entities/CasinoBonus.php");
require_once("queries/CasinosListQuery.php");

class CasinosList
{
    const LIMIT = 100;
    const BEST_CASINO_LIMIT = 50;
    private $filter;

    public function __construct(CasinoFilter $filter)
    {
        $this->filter = $filter;
    }

    private function setLimitCustomLimitForLabel($label){

        $limit = self::LIMIT;

        if($label == 'Best')
        {
            $limit = self::BEST_CASINO_LIMIT;
        }

        return $limit;
    }

    public function getResults($sortBy, $page = 1, $limit = self::LIMIT, $offset = "") {

        $output = array();
        $label = $this->filter->getCasinoLabel();

        if(!empty($label))
            $limit = $this->setLimitCustomLimitForLabel($label);

        if (!empty($offset) && $page > 1) {

            $offset = ($page-1) *$limit ;
        }else{
            $offset = 0;
        }

        $queryGenerator = new CasinosListQuery(
            $this->filter,
            array("status_id", "t1.id", "t1.name", "t1.code", "(t1.rating_total/t1.rating_votes) AS average_rating", "t1.date_established", "IF(t2.id IS NOT NULL, 1, 0) AS is_country_supported"),
            $sortBy,
            $limit,
            $offset
        );
        $query = $queryGenerator->getQuery();


        // execute query
        $resultSet = DB($query);
        while($row = $resultSet->toRow()) {
            $object = new Casino();
            $object->id = $row["id"];
            $object->name = $row["name"];
            $object->code = $row["code"];
            $object->rating = ceil($row["average_rating"]);
            $object->is_country_accepted = $row["is_country_supported"];
            $object->date_established = $row["date_established"];
            $object->date_formatted = $this->formatDate($row["date_established"]);
            $object->status = $row["status_id"];
            $output[$row["id"]] = $object;
        }
        if(empty($output)) return array();

        // signal engine that utf8 is expected to come

        
        // append softwares
        $query = "
        SELECT t1.casino_id, t2.name 
        FROM casinos__game_manufacturers AS t1
        INNER JOIN game_manufacturers AS t2 ON t1.game_manufacturer_id = t2.id
        WHERE t1.casino_id IN (".implode(",", array_keys($output)).") ORDER BY t1.is_primary DESC;
        ";
        $resultSet = DB($query);
        while($row = $resultSet->toRow()) {
            $output[$row["casino_id"]]->softwares[] = $row["name"];
        }
        // append bonuses
        $query = "
        SELECT t1.casino_id, t1.codes, t1.amount, t1.wagering, t1.minimum_deposit, t1.games, t2.name 
        FROM casinos__bonuses AS t1
        INNER JOIN bonus_types AS t2 ON t1.bonus_type_id = t2.id
        WHERE t1.casino_id IN (".implode(",", array_keys($output)).") AND t2.name IN ('No Deposit Bonus','First Deposit Bonus','Free Spins','Free Play')
        ";
        $resultSet = DB($query);
        while($row = $resultSet->toRow()) {
            $bonus = new CasinoBonus();
            $bonus->amount = ($row["name"]=="Free Spins"?trim(str_replace("FS","",$row["amount"])):$row["amount"]);
            $bonus->min_deposit = $row["minimum_deposit"];
            $bonus->wagering = $row["wagering"];
            $bonus->games_allowed = $row["games"];
            $bonus->code = $row["codes"];
            $bonus->type = $row["name"];
            if($row["name"]=="No Deposit Bonus" || $row["name"]=="Free Spins" || $row["name"]=="Free Play" || $row["name"]=="Bonus Spins") {
                $output[$row["casino_id"]]->bonus_free = $bonus;
            } else {
                $output[$row["casino_id"]]->bonus_first_deposit = $bonus;
            }
        }
        return array_values($output);
    }
    
    public function formatDate($date) {
        $date_arr = explode('-', $date);
        $month_name = date('M', strtotime($date));
        return $month_name.'. '.$date_arr[2].', '.$date_arr[0];
    }

    public function getTotal() {
        // build query
        $queryGenerator = new CasinosListQuery($this->filter, array("COUNT(t1.id) AS nr"));
        $query = $queryGenerator->getQuery();
        return  DB($query)->toValue();
    }
}