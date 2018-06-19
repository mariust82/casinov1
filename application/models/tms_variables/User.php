<?php
class User extends \TMS\VariablesHolder
{
    public function country() {
        return $this->parameters["request"]->getAttribute("country")->name;
    }
}
