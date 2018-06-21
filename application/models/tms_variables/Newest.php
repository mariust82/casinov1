<?php
/**
 * Created by PhpStorm.
 * User: Alexandru.D
 * Date: 6/21/2018
 * Time: 11:11 AM
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/application/models/CasinoFilter.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/application/models/dao/CasinosList.php";
class Newest extends \TMS\VariablesHolder {

    public function getNewestCasinoInTheList(){
        $filterParams[$this->parameters["response"]->getAttribute("filter")] = $this->parameters["response"]->getAttribute("selected_entity");
        $filter = new CasinoFilter($filterParams, $this->parameters["response"]->getAttribute("country"));
        $object = new CasinosList($filter);

        return $object->getResults(CasinoSortCriteria::NEWEST, 0, 1)[0]->name;
    }

    public function getNewestCasinoInTheSite(){
        $casinoName = DB("
          SELECT name FROM casinos
          WHERE is_open = 1
          AND date_established > DATE_SUB(CURDATE(), INTERVAL 1 YEAR)
          ORDER BY date_established DESC LIMIT 1
        ")->toValue();
        $casinoCode = strtolower(str_replace(" ","-", $casinoName));
        return '<a href="/visit/'.$casinoCode.'">'.$casinoName.'</a>';
    }

}