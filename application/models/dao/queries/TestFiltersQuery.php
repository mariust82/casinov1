<?php

/**
 * Class TestFiltersQuery
 */
abstract class TestFiltersQuery
{
    public function __construct(array $filtersParameters)
    {
        $this->filtersData = $filtersParameters;
        $this->setMainQueryBody();
        $this->setWhere();
        $this->setOrderBy();
        $this->setLimit();
        //$this->setFields();
        //$this->setJoins();
        //$this->setGroupBy($limit);

    }

    //abstract protected function setFields(array $fields = []): void;

    abstract protected function setMainQueryBody(): void;

    abstract protected function setWhere(): void;

    abstract protected function setOrderBy(): void;

    /**
     * Set limit and offset.
     *
     * @param int|null $offset
     * @param int|null $limit
     */
    //abstract protected function setLimit(?int $offset, ?int $limit): void;
}