<?php
/**
 * Created by PhpStorm.
 * User: Alexandru.D
 * Date: 6/21/2018
 * Time: 11:11 AM
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/application/models/CasinoFilter.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/application/models/dao/CasinosList.php";
class Newest extends \TMS\VariablesHolder
{
    public function getNewestCasinoInTheList()
    {
        $filterParams[$this->parameters["response"]->attributes("filter")] = $this->parameters["response"]->attributes("selected_entity");
        $filter = new CasinoFilter($filterParams, $this->parameters["response"]->attributes("country"));
        $object = new CasinosList($filter);

        $results = $object->getResults(CasinoSortCriteria::NEWEST, 0, 1);
        if ($results) {
            $casino = reset($results);
            $casinoCode = strtolower(str_replace(" ", "-", $casino->name));
            return '<a href="/reviews/'.$casinoCode.'-review">'.$casino->name.'</a>';
        }
    }

    public function getNewestCasinoInTheSite()
    {
        $casinoName = SQL("
          SELECT name FROM casinos
          WHERE is_open = 1
          AND date_established > DATE_SUB(CURDATE(), INTERVAL 1 YEAR)
          ORDER BY date_established DESC LIMIT 1
        ")->toValue();
        if ($casinoName) {
            $casinoCode = strtolower(str_replace(" ", "-", $casinoName));
            return '<a href="/reviews/'.$casinoCode.'-review">' . $casinoName . '</a>';
        }
    }
}
