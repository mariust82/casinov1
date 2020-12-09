<?php
class Country extends Entity
{
    const EXCLUDED_COUNTRY_CODE = "DE";

    public $id;
    public $code;
    public $name;
}
