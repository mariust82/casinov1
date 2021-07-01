<?php

/**
 * Class AbstractQuery
 */
class AbstractQuery
{

    /**
     * @var array
     */
    protected array $parameters = [];

    /**
     * @var \Lucinda\Query\Select
     */
    protected \Lucinda\Query\Select $select;

    /**
     * Get query string.
     *
     * @return string
     */
    public function getQuery(): string
    {
        return $this->select->toString();
    }

    /**
     * Get parameters.
     *
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

}