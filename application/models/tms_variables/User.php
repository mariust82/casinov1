<?php
class User extends \TMS\VariablesHolder
{
    public function getCountry()
    {
        var_dump($this->parameters["response"]->attributes("country"));
        return $this->parameters["response"]->attributes("country")->name;
    }
}
