<?php

class Test extends \TMS\VariablesHolder
{
    public function me()
    {
        return $this->parameters["country"]->name;
    }

    public function you()
    {
        return "You";
    }

    public function they()
    {
        return "They";
    }
}
