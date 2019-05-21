<?php
/**
 * Created by PhpStorm.
 * User: Alexandru.D
 * Date: 6/21/2018
 * Time: 11:07 AM
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/application/models/CasinoFilter.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/application/models/dao/CasinosList.php";
class TopRated extends \TMS\VariablesHolder {

    public function getTopRatedCasinoInTheList(){
        $filterParams[$this->parameters["response"]->attributes()->get("filter")] = $this->parameters["response"]->attributes()->get("selected_entity");
        $filter = new CasinoFilter($filterParams, $this->parameters["response"]->attributes()->get("country"));
        $object = new CasinosList($filter);

        $casino = $object->getResults(CasinoSortCriteria::TOP_RATED, 0, 1)[0];
        if($casino){
            $casinoCode = strtolower(str_replace(" ","-", $casino->name));
            return '<a href="/visit/'.$casinoCode.'">'.$casino->name.'</a>';
        }
    }

    public function getTopRatedCasinoInTheSite(){
        $casinoName = SQL("
          SELECT name, (rating_total/rating_votes) AS average_rating FROM casinos
          WHERE is_open = 1
          AND date_established > DATE_SUB(CURDATE(), INTERVAL 1 YEAR)
          ORDER BY average_rating DESC, priority DESC, id DESC LIMIT 1
        ")->toValue();
        if($casinoName) {
            $casinoCode = strtolower(str_replace(" ", "-", $casinoName));
            return '<a href="/visit/' . $casinoCode . '">' . $casinoName . '</a>';
        }
    }

}