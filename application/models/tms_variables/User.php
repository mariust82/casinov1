<?php
class User extends \TMS\VariablesHolder
{
    public function getCountry()
    {
        return $this->parameters["response"]->attributes("country")->name;
    }
}
