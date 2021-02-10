<?php
require_once("CasinosListController.php");
require_once("application/models/CasinoFilter.php");
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/dao/CasinoLabels.php");
require_once("application/models/dao/CasinosList.php");

/*
* Casinos list by label
*
* @requestMethod GET
* @responseFormat HTML
* @source
* @pathParameter name string Name of casino label
*/

class CasinosByLowMinimumDepositController extends CasinosListController
{
    protected $limit = 100;

    /**
     *
     */
    protected function init()
    {
        $this->response->attributes("limit_per_page", $this->limit);
    }

    /**
     * Get selected entity.
     *
     * @return string
     */
    protected function getSelectedEntity()
    {
        return "Low Minimum Deposit";
    }

    /**
     * Get filter.
     *
     * @return string
     */
    protected function getFilter()
    {
        return "label";
    }

    /**
     * Get sort criteria.
     *
     * @return int
     */
    protected function getSortCriteria()
    {
        return CasinoSortCriteria::MINIMUM_DEPOSIT;
    }

}
