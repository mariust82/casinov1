<?php
/**
 * Created by PhpStorm.
 * User: Alexandru.D
 * Date: 6/21/2018
 * Time: 11:07 AM
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/application/models/CasinoFilter.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/application/models/dao/CasinosList.php";
class TopRated extends \TMS\VariablesHolder
{
    public function getTopRatedCasinoInTheList()
    {
        $filterParams[$this->parameters["response"]->attributes("filter")] = $this->parameters["response"]->attributes("selected_entity");
        $filter = new CasinoFilter($filterParams, $this->parameters["response"]->attributes("country"));
        $object = new CasinosList($filter);

        $casino = $object->getResults(CasinoSortCriteria::TOP_RATED, 0, 1)[0];
        if ($casino) {
            $casinoCode = strtolower(str_replace(" ", "-", $casino->name));
            return '<a href="/reviews/'.$casinoCode.'-review">'.$casino->name.'</a>';
        }
        return '';
    }

    public function getTopRatedCasinoInTheSite()
    {
        $casinoName = SQL("
          SELECT name, (rating_total/rating_votes) AS average_rating FROM casinos
          WHERE is_open = 1
          AND date_established > '".date("Y-m-d", strtotime(date("Y-m-d")." -1 year"))."'
          ORDER BY average_rating DESC, priority DESC, id DESC LIMIT 1
        ")->toValue();
        if ($casinoName) {
            $casinoCode = strtolower(str_replace(" ", "-", $casinoName));
            return '<a href="/reviews/'.$casinoCode.'-review">' . $casinoName . '</a>';
        }
        return '';
    }
}
