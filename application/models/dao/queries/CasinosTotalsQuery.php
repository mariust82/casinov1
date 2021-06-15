<?php

require_once("CasinosQuery.php");

/**
 * Class CasinosTotalsQuery
 */
class CasinosTotalsQuery extends CasinosQuery
{

    /**
     * @inheritDoc
     */
    protected function setFields(array $fields = []): void
    {
        if ($this->filter->getPlayVersion() === 'Live Dealer') {
            $this->select->fields()->add("COUNT(DISTINCT t1.id)", "nr");
        } else {
            $this->select->fields()->add("COUNT(t1.id)", "nr");
        }
    }

    /**
     * @inheritDoc
     */
    protected function setOrderBy(?int $sortBy = null): void
    {
    }

    /**
     * @inheritDoc
     */
    protected function setLimit(?int $offset, ?int $limit): void
    {
    }
}