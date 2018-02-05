<?php
/**
 * Encapsulates operations with countries.
 */
class Countries
{
    /**
     * Gets country ID based on ISO code.
     *
     * @param string $code
     * @return integer
     */
    public function getIDByCode($code)
    {
        return DB("SELECT id from countries WHERE code=:code", array(':code' => $code))->toValue();
    }
}