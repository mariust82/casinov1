<?php
class User extends \TMS\VariablesHolder
{
    public function getCountry()
    {
        return $this->parameters["request"]->attributes("country")->name;
    }
}
