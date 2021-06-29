<?php

require_once("CasinosQuery.php");

/**
 * Class CasinosListQuery
 */
class CasinosListQuery extends CasinosQuery
{

    /**
     * @inheritDoc
     */
    protected function setFields(array $fields = []): void
    {
        $this->select->distinct();
        $fields = $this->select->fields($fields);
        $fields->add('t19.id', 'complex_case');
        if ($this->filter->getCasinoLabel() === 'Fast Payout') {
            $fields->add("t18.end");
        }
    }

    /**
     * @inheritDoc
     */
    protected function setOrderBy(?int $sortBy = null): void
    {
        if ($sortBy) {
            $orderBy = $this->select->orderBy();
            switch ($sortBy) {
                case CasinoSortCriteria::NEWEST:
                    $orderBy->add("t1.date_established", "DESC");
                    $orderBy->add("t1.priority", "DESC");
                    $orderBy->add("t1.id", "DESC");
                    break;
                case CasinoSortCriteria::DATE_ADDED:
                    $orderBy->add("complex_case", "ASC");
                    $orderBy->add("t1.date_added", "DESC");
                    $orderBy->add("t1.priority", "DESC");
                    $orderBy->add("t1.id", "DESC");
                    break;
                case CasinoSortCriteria::TOP_RATED:
                    $orderBy->add("complex_case", "ASC");
                    $orderBy->add("(t1.rating_total/t1.rating_votes)", "DESC");
                    $orderBy->add("t1.priority", "DESC");
                    $orderBy->add("t1.id", "DESC");
                    break;
                case CasinoSortCriteria::POPULARITY:
                    $orderBy->add("complex_case", "ASC");
                    $orderBy->add("t1.clicks", "DESC");
                    $orderBy->add("t1.id", "DESC");
                    break;
                case CasinoSortCriteria::WAGERING:
                    $orderBy->add("t5.id", "ASC");
                    break;
                case CasinoSortCriteria::NO_ACCOUNT:
                    $orderBy->add("t1.priority", "DESC");
                    $orderBy->add("t1.date_established", "DESC");
                    $orderBy->add("t1.id", "DESC");
                    break;
                case CasinoSortCriteria::FAST_PAYOUT:
                    $orderBy->add("t18.end", "ASC");
                    $orderBy->add("t1.priority", "DESC");
                    $orderBy->add("t1.id", "DESC");
                    break;
                case CasinoSortCriteria::MINIMUM_DEPOSIT:
                    $orderBy->add("t1.deposit_minimum", "ASC");
                    $orderBy->add("t1.priority", "DESC");
                    $orderBy->add("t1.name", "ASC");
                    break;
                default:
                    $orderBy->add("complex_case", "ASC");
                    $orderBy->add("t1.priority", "DESC");
                    $orderBy->add("t1.id", "DESC");
                    $this->filter->setPromoted(true);
                    break;
            }
        }
    }

    /**
     * @inheritDoc
     */
    protected function setLimit(?int $offset, ?int $limit): void
    {
        if ($limit) {
            $this->select->limit($limit, $offset);
        }
    }
}
